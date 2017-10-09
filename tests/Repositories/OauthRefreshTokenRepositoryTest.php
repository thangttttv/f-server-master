<?php namespace Tests\Repositories;

use App\Models\OauthRefreshToken;
use Tests\TestCase;

class OauthRefreshTokenRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\OauthRefreshTokenRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthRefreshTokenRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

}
