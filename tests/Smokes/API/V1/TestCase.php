<?php

namespace Tests\Smokes\API\V1;

use Tests\TestCase as BaseTestCase;
use Laravel\Passport\ClientRepository;

class TestCase extends BaseTestCase
{
    /** @var bool */
    protected $useDatabase = true;

    protected $clientName = "TEST_CLIENT";

    public function setUp()
    {
        exec('php artisan migrate --database testing');
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
        exec('php artisan migrate:rollback --database testing');
    }

    protected function getClientIdAndSecret()
    {
        $client = \DB::table('oauth_clients')->where('name', $this->clientName)->first();
        if( empty($client) ) {
            $clients = new ClientRepository();
            $client = $clients->createPasswordGrantClient(
                null, $this->clientName, 'http://localhost'
            );
        }

        return [$client->id, $client->secret];
    }

}
