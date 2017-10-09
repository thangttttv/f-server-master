<?php namespace Tests\Repositories;

use App\Models\OauthAccessToken;
use Tests\TestCase;

class OauthAccessTokenRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\OauthAccessTokenRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthAccessTokenRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

}
