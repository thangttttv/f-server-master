<?php
namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertiser\SignInRequest;
use App\Services\AdvertiserServiceInterface;

class AuthController extends Controller
{
    /** @var \App\Services\AdvertiserServiceInterface AdvertiserUserService */
    protected $advertiserService;

    public function __construct(AdvertiserServiceInterface $advertiserService)
    {
        $this->advertiserService = $advertiserService;
    }

    public function getSignIn()
    {
        return view('pages.advertiser.auth.signin', []);
    }

    public function postSignIn(SignInRequest $request)
    {
        $advertiserUser = $this->advertiserService->signIn($request->all());
        if (empty($advertiserUser)) {
            return redirect()->action('Advertiser\AuthController@getSignIn');
        }

        return \RedirectHelper::intended(action('Advertiser\DashboardController@index'), $this->advertiserService->getGuardName());
    }

    public function postSignOut()
    {
        $this->advertiserService->signOut();

        return redirect()->action('Advertiser\AuthController@getSignIn');
    }
}
