<?php namespace Tests\Models;

use App\Models\OauthAccessToken;
use Tests\TestCase;

class OauthAccessTokenTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\OauthAccessToken $oauthAccessToken */
        $oauthAccessToken = new OauthAccessToken();
        $this->assertNotNull($oauthAccessToken);
    }

}
