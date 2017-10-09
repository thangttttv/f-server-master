<?php
namespace App\Http\Responses\API\V1;

class AccessToken extends Response
{
    protected $columns = [
        'token_type'    => 'Bearer',
        'expires_in'    => 0,
        'access_token'  => '',
        'refresh_token' => '',
    ];

    protected $optionalColumns = [
    ];

    public static function token(
        $token, $tokenType = 'Bearer', $expires_in = 0, $refreshToken = ''
    ) {
        $response = new static([
            'token_type'    => $tokenType,
            'expires_in'    => $expires_in,
            'access_token'  => $token,
            'refresh_token' => $refreshToken,
        ], 200);

        return $response;
    }
}
