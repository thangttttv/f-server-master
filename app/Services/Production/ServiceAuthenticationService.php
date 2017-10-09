<?php
namespace App\Services\Production;

use App\Repositories\AuthenticatableRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\ServiceAuthenticationRepositoryInterface;
use App\Services\ServiceAuthenticationServiceInterface;
use Facebook\Facebook;

class ServiceAuthenticationService extends BaseService implements ServiceAuthenticationServiceInterface
{
    /** @var \App\Repositories\ServiceAuthenticationRepositoryInterface */
    protected $serviceAuthenticationRepository;

    /** @var \App\Repositories\AuthenticatableRepositoryInterface */
    protected $authenticatableRepository;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    public function __construct(
        AuthenticatableRepositoryInterface $authenticatableRepository,
        ServiceAuthenticationRepositoryInterface $serviceAuthenticationRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->authenticatableRepository       = $authenticatableRepository;
        $this->serviceAuthenticationRepository = $serviceAuthenticationRepository;
        $this->imageRepository                 = $imageRepository;
    }

    /**
     * @param string $service
     * @param array  $input
     *
     * @return \App\Models\AuthenticatableBase
     */
    public function getAuthModel($service, $input)
    {
        $columnName = $this->serviceAuthenticationRepository->getAuthModelColumn();

        $authInfo = $this->serviceAuthenticationRepository->findByServiceAndId($service,
            array_get($input, 'service_id'));
        if (!empty($authInfo)) {
            return $this->authenticatableRepository->find($authInfo->$columnName);
        }

        $authUser = $this->authenticatableRepository->findByEmail(array_get($input, 'email'));
        if (!empty($authUser)) {
            $authInfo = $this->serviceAuthenticationRepository->findByServiceAndAuthModelId($service, $authUser->id);
            if (!empty($authInfo)) {
                return $authUser;
            }
        } else {
            if (array_key_exists('avatar', $input)) {
                $image = $this->imageRepository->create([
                    'url'        => $input['avatar'],
                    'is_enabled' => true,
                ]);
                $input['profile_image_id'] = $image->id;
            }
            $authUser = $this->authenticatableRepository->create($input);
        }

        $input[$columnName] = $authUser->id;
        $this->serviceAuthenticationRepository->create($input);

        return $authUser;
    }

    public function facebookSignIn($fbToken)
    {
        $fb = new Facebook([
            'app_id'     => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
        ]);
        $serviceUser   = $fb->get('/me?fields=id,email,first_name,last_name,picture', $fbToken)->getGraphUser();
        $serviceUserId = $serviceUser->getId();
        $name          = $serviceUser->getFirstName().''.$serviceUser->getLastName();
        $email         = $serviceUser->getEmail();
        if (empty($email)) {
            return;
        }

        $array = [
            'service'    => 'facebook',
            'service_id' => $serviceUserId,
            'name'       => $name,
            'email'      => $email,
            'first_name' => $serviceUser->getFirstName(),
            'last_name'  => $serviceUser->getLastName(),
        ];
        $authUser = $this->getAuthModel('facebook', $array);

        return $authUser;
    }
}
