<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LicenceRequest;
use App\Http\Requests\API\V1\StatusRequest;
use App\Http\Responses\API\V1\Status;
use App\Http\Responses\API\V1\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\APIUserServiceInterface;
use App\Services\FileUploadServiceInterface;

class IndexController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var \App\Services\FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    public function __construct(
        APIUserServiceInterface $userService,
        UserRepositoryInterface $userRepository,
        FileUploadServiceInterface $fileUploadService
    ) {
        $this->userService       = $userService;
        $this->userRepository    = $userRepository;
        $this->fileUploadService = $fileUploadService;
    }

    public function status(StatusRequest $request)
    {
        $stats = $request->get('status');

        return Status::ok()->response();
    }

    public function getMe()
    {
        $user = $this->userService->getUser();

        return User::updateWithModel($user)->response();
    }

    public function postDriverLicenceImage(LicenceRequest $request)
    {
        $user = $this->userService->getUser();
        if (!$request->hasFile('licence_image')) {
            throw new APIErrorException('wrongParameter', 'No image', []);
        }
        $file      = $request->file('licence_image');
        $mediaType = $file->getClientMimeType();
        $path      = $file->getPathname();
        $image     = $this->fileUploadService->upload('licence-image', $path, $mediaType, [
            'entityType' => 'licence',
            'entityId'   => $user->id,
            'title'      => $user->present()->userName(),
        ]);

        if (empty($image)) {
            throw new APIErrorException('unknown', '', []);
        }
        $this->userRepository->update($user, ['drivers_licence_image_id' => $image->id]);
        $user = $this->userService->getUser();

        return User::updateWithModel($user)->response();
    }
}
