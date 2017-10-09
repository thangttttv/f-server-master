<?php
namespace App\Services;

interface OAuthServiceInterface extends BaseServiceInterface
{
    /**
     * @param int $userId
     *
     * @return string
     */
    public function generateToken($userId);

    /**
     * @param $userId
     *
     * @return $string
     */
    public function generateTokenResetPassword($userId);
}
