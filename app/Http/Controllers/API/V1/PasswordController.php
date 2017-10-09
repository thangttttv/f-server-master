<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\PasswordController as PasswordControllerBase;
use App\Http\Requests\API\V1\PasswordRequest;
use App\Http\Responses\API\V1\Status;
use App\Repositories\UserRepositoryInterface;
use App\Services\OAuthServiceInterface;

class PasswordController extends PasswordControllerBase
{
    /** @var \App\Repositories\UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var string $emailSetPageView */
    protected $emailSetPageView = 'pages.user.auth.forgot-password';

    /** @var string $passwordResetPageView */
    protected $passwordResetPageView = 'pages.user.auth.reset-password';

    /** @var string $returnAction */
    protected $returnAction = '';

    /** @var OAuthServiceInterface $oauthService */
    protected $oauthService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OAuthServiceInterface $oauthService
    ) {
        $this->userRepository = $userRepository;
        $this->oauthService   = $oauthService;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \App\Http\Requests\API\V1\PasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws APIErrorException
     */
    public function postForgotPasswordApi(PasswordRequest $request)
    {
        $email = $request->get('email');

        /** @var \App\Models\User $user */
        $user  = $this->userRepository->findByEmail($email);
        if (empty($user)) {
            throw new APIErrorException('wrongParameter', 'Email doesn\'t exist', []);
        }
        $token = $this->oauthService->generateTokenResetPassword($user->id);
        /** @var \App\Services\MailServiceInterface $mailService */
        $mailService = \App::make('App\Services\MailServiceInterface');
        $mailService->sendEmailForgotPassWord($user->email, $token);

        return Status::ok()->response();
    }
}
