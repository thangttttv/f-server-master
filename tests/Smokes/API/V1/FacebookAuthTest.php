<?php
namespace Tests\Smokes\API\V1;

use App\Models\User;

class FacebookAuthTest extends TestCase
{
    protected $useDatabase = true;

    public function testSignUp()
    {
        /*
        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'fb_token'      => 'ACCESS_TOKEN',
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'scope'         => '',
        ];

        $response = $this->call('POST', '/api/v1/facebook-signin', $input, [], [],
            $this->transformHeadersToServerVars($headers));

        $data = json_decode($response->getContent(), true);

        $this->assertResponseStatus(200);
        */  
    }

}
