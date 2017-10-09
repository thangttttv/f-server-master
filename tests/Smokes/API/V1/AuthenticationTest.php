<?php
namespace Tests\Smokes\API\V1;

use App\Models\User;

class AuthenticationTest extends TestCase
{
    protected $useDatabase = true;

    public function testSignUp()
    {
        $headers = [];

        $email = $this->faker->email;
        $password = $this->faker->password(8);

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();


        $input = [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'email'         => $email,
            'password'      => $password,
            'phone_number'  => $this->faker->phoneNumber,
            'country_code'  => 'th',
            'city_id'       => 1,
            'main_area_id'  => 1,
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'date_of_birth' => $this->faker->date(),
            'scope'         => '',
        ];

        $response = $this->call('POST', '/api/v1/signup', $input, [], [],
            $this->transformHeadersToServerVars($headers));

        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(201);
    }

    public function testSignIn()
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
    }

    public function testGetMe()
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

        $type = $data['token_type'];
        $token = $data['access_token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $response = $this->call('GET', '/api/v1/me', $input, [], [], $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

        $this->assertEquals($data['email'], $email);
    }

}
