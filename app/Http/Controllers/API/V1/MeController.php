<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\BankAccountRequest;
use App\Http\Requests\API\V1\MessageImageRequest;
use App\Http\Requests\API\V1\ProfileImageUpdateRequest;
use App\Http\Requests\API\V1\ProfileUpdateRequest;
use App\Http\Responses\API\V1\MessageImage;
use App\Http\Responses\API\V1\User;

use App\Repositories\BankAccountRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\APIUserServiceInterface;
use App\Services\FileUploadServiceInterface;

class MeController extends Controller
{
    /** @var APIUserServiceInterface */
    protected $userService;

    /** @var UserRepositoryInterface */
    protected $userRepository;

    /** @var FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    /** @var BankAccountRepositoryInterface $bankAccountRepository */
    protected $bankAccountRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        UserRepositoryInterface $userRepository,
        FileUploadServiceInterface $fileUploadService,
        BankAccountRepositoryInterface $bankAccountRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->userService              = $userService;
        $this->userRepository           = $userRepository;
        $this->fileUploadService        = $fileUploadService;
        $this->bankAccountRepository    = $bankAccountRepository;
        $this->imageRepository          = $imageRepository;
    }

    public function getMe()
    {
        /** @var \App\Models\User $user */
        $user = $this->userService->getUser();

        return User::updateWithModel($user)->response();
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user  = $this->userService->getUser();
        $input = $request->only(['first_name', 'last_name', 'minimum_revenue',
            'phone_number', 'date_of_birth', 'main_area_id', 'city_id', 'country_code', ]);
        $this->userRepository->update($user, $input);
        $user = $this->userRepository->find($user->id);

        return User::updateWithModel($user)->response();
    }

    public function updateProfileImage(ProfileImageUpdateRequest $request)
    {
        $user  = $this->userService->getUser();
        if (!$request->hasFile('profile_image')) {
            throw new APIErrorException('wrongParameter', 'No image', []);
        }

        $file      = $request->file('profile_image');
        $mediaType = $file->getClientMimeType();
        $path      = $file->getPathname();
        $image     = $this->fileUploadService->upload('user-profile-image', $path, $mediaType, [
            'entityType' => 'teacher-profile',
            'entityId'   => $user->id,
            'title'      => $request->input('name', ''),
        ]);

        if (!empty($image)) {
            $imageOld = $user->profileImage;
            if (!empty($imageOld)) {
                $this->fileUploadService->delete($imageOld);
                $this->imageRepository->delete($imageOld);
            }
            $this->userRepository->update($user, [
                'profile_image_id' => $image->id,
            ]);
        }

        $user = $this->userRepository->find($user->id);

        return User::updateWithModel($user)->response();
    }

    public function postBankAccount(BankAccountRequest $request)
    {
        $user = $this->userService->getUser();

        $bankAccount = $this->bankAccountRepository->findByUserId($user->id);
        $input       = $request->only(['bank_id', 'branch_name',
            'owner_name', 'account_info', ]);
        $input['user_id'] = $user->id;
        if (empty($bankAccount)) {
            $bankAccount = $this->bankAccountRepository->create($input);
        } else {
            $bankAccount = $this->bankAccountRepository->update($bankAccount, $input);
        }
        $userUpdated = $this->userRepository->find($user->id);

        return User::updateWithModel($userUpdated)->response();
    }

    public function postMessageImage(MessageImageRequest $request)
    {
        $user = $this->userService->getUser();
        if (!$request->hasFile('message_image')) {
            throw new APIErrorException('wrongParameter', 'No Image', []);
        }

        $file      = $request->file('message_image');
        $mediaType = $file->getClientMimeType();
        $path      = $file->getPathname();
        $image     = $this->fileUploadService->upload('message-image', $path, $mediaType, [
            'entityType' => 'message',
            'entityId'   => $user->id,
            'title'      => '',
        ]);
        if (empty($image)) {
            if (!$request->hasFile('message_image')) {
                throw new APIErrorException('severError', 'Upload failed', []);
            }
        }

        return MessageImage::updateWithModel($image)->response();
    }
}
