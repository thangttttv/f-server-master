<?php namespace Tests\Models;

use App\Models\OauthClient;
use Tests\TestCase;

class OauthClientTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\OauthClient $oauthClient */
        $oauthClient = new OauthClient();
        $this->assertNotNull($oauthClient);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\OauthClient $oauthClient */
        $oauthClientModel = new OauthClient();

        $oauthClientData = factory(OauthClient::class)->make();
        foreach( $oauthClientData->toFillableArray() as $key => $value ) {
            $oauthClientModel->$key = $value;
        }
        $oauthClientModel->save();

        $this->assertNotNull(OauthClient::find($oauthClientModel->id));
    }

}
