<?php


namespace Tests\Smokes\API\V1;


use App\Models\User;

class PaymentLogTest extends TestCase
{
    protected $useDatabase = true;

    public function testIndex()
    {
        $email = $this->faker->email;
        $password = $this->faker->password(8);
        $user = factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'username'      => $email,
            'password'      => $password,
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'scope'         => '',
        ];

        $response = $this->call('POST', '/api/v1/token', $input, [], [], $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

        $token = $data['access_token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $input = [];
        $response = $this->call('GET', '/api/v1/me/payment-logs', $input, [], [], $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

    }
}