<?php
namespace App\Services;

interface ServiceAuthenticationServiceInterface extends BaseServiceInterface
{
    /**
     * @param string $service
     * @param array  $input
     *
     * @return \App\Models\AuthenticatableBase
     */
    public function getAuthModel($service, $input);

    /**
     * @param $fbToken
     *
     * @return \App\Models\AuthenticatableBase
     */
    public function facebookSignIn($fbToken);
}
