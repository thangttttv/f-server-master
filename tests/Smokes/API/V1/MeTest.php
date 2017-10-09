<?php


namespace Tests\Smokes\API\V1;


use App\Models\Bank;
use App\Models\User;

class MeTest extends TestCase
{
    protected $useDatabase = true;

    public function testPostBankAccount()
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
        $bank = factory(Bank::class)->create([
            'name'        => 'test bank',
            'description' => 'description',
            'order'       => 1,
        ]);

        $ownerName = 'tester name';
        $input = [
            'bank_id'      => $bank->id,
            'user_id'      => $user->id,
            'branch_name'  => 'tester branch name',
            'owner_name'   => 'tester name',
            'account_info' => 'text',
        ];
        $response = $this->call('POST', '/api/v1/me/bank-account', $input, [], [], $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);
        $this->assertEquals($data['bankAccounts'][0]['ownerName'], $ownerName);

    }
}