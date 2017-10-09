<?php namespace Tests\Models;

use App\Models\OauthRefreshToken;
use Tests\TestCase;

class OauthRefreshTokenTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\OauthRefreshToken $oauthRefreshToken */
        $oauthRefreshToken = new OauthRefreshToken();
        $this->assertNotNull($oauthRefreshToken);
    }


}
