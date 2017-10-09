<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\PsrServerRequest;
use App\Http\Requests\API\V1\RefreshTokenRequest;
use App\Http\Requests\API\V1\Request;
use App\Http\Requests\API\V1\SignInRequest;
use App\Http\Requests\API\V1\SignUpRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserServiceInterface;

use League\OAuth2\Server\AuthorizationServer;
use Zend\Diactoros\Response as Psr7Response;

class AuthController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var AuthorizationServer */
    protected $server;

    /** @var UserRepositoryInterface */
    protected $userRepository;

    public function __construct(
        UserServiceInterface $userService,
        AuthorizationServer $server,
        UserRepositoryInterface $userRepository
    ) {
        $this->userService = $userService;
        $this->server      = $server;
        $this->userRepository      = $userRepository;
    }

    public function postSignUp(SignUpRequest $request)
    {
        $this->userService->checkClient($request);
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'password',
            'phone_number',
            'country_code',
            'date_of_birth',
            'city_id',
            'main_area_id',
        ]);
        /** @var \App\Models\User $user */
        $userDeleted = $this->userRepository->findByEmailDeleted($input['email']);
        if(!empty($userDeleted)){
            $userDeleted->restore();
            $user = $userDeleted;
        }else{
            $user = $this->userService->signUp($input);
        }

        if (empty($user)) {
            throw new APIErrorException('authFailed', 'Register failed', []);
        }

        $params             = $request->all();
        $params['username'] = $params['email'];

        $serverRequest = PsrServerRequest::createFromRequest($request, $params);

        $response = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);

        return $response->withStatus(201);
    }

    public function postSignIn(SignInRequest $request)
    {
        $this->userService->checkClient($request);
        $inputCheckUser             = $request->only('username', 'password');
        $inputCheckUser['email']    = $inputCheckUser['username'];
        $user                       = $this->userService->signIn($inputCheckUser);
        if (empty($user)) {
            throw new APIErrorException('signInFailed', '', []);
        }
        $serverRequest = PsrServerRequest::createFromRequest($request);

        return $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
    }

    public function postRefreshToken(RefreshTokenRequest $request)
    {
        $this->userService->checkClient($request);
        $serverRequest = PsrServerRequest::createFromRequest($request);

        return $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
    }
}
