<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\FacebookSigninRequest;
use App\Http\Requests\API\V1\PsrServerRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\OAuthServiceInterface;
use App\Services\UserServiceAuthenticationServiceInterface;
use App\Services\UserServiceInterface;
use League\OAuth2\Server\AuthorizationServer;
use Zend\Diactoros\Response as Psr7Response;

class FacebookAuthController extends Controller
{
    /** @var \App\Services\UserServiceAuthenticationServiceInterface $serviceAuthenticationService */
    protected $serviceAuthenticationService;

    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var \App\Services\OAuthServiceInterface $oauthService */
    protected $oauthService;

    /** @var AuthorizationServer */
    protected $server;

    public function __construct(
        UserServiceInterface $userService,
        UserServiceAuthenticationServiceInterface $serviceAuthenticationService,
        UserRepositoryInterface $userRepository,
        OAuthServiceInterface $oauthService,
        AuthorizationServer $server
    ) {
        $this->userService                  = $userService;
        $this->serviceAuthenticationService = $serviceAuthenticationService;
        $this->userRepository               = $userRepository;
        $this->oauthService                 = $oauthService;
        $this->server                       = $server;
    }

    public function facebookSignIn(FacebookSigninRequest $request)
    {
        /* @var \App\Models\User $authUser */
        $this->userService->checkClient($request);
        $authUser = $this->serviceAuthenticationService->facebookSignIn($request->get('fb_token'));
        if (empty($authUser)) {
            throw new APIErrorException('authFacebookFailed', 'Signin facebook failed, Cannot get user email from facebook', []);
        }
        $password          = $authUser->password;
        $temporaryPassword = str_random(16);
        $this->userRepository->update($authUser, [
            'password' => $temporaryPassword,
        ]);
        $params = [
            'username' => $authUser->email,
            'password' => $temporaryPassword,
        ] + $request->all();
        try {
            $serverRequest = PsrServerRequest::createFromRequest($request, $params);
            $response      = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
            $this->userRepository->updateRawPassword($authUser, $password);
        } catch (\Exception $e) {
            $this->userRepository->updateRawPassword($authUser, $password);
            throw $e;
        }

        return $response;
    }
}
