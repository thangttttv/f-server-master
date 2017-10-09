<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class OauthClientControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\OauthClientController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\OauthClientController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\OauthClientController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\OauthClientController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $oauthClient = factory(\App\Models\OauthClient::class)->make();
        $this->action('POST', 'Admin\OauthClientController@store', [
                '_token' => csrf_token(),
            ] + $oauthClient->toArray());
        $this->assertResponseStatus(302);
    }


    public function testDeleteModel()
    {
        $oauthClient = factory(\App\Models\OauthClient::class)->create();

        $id = $oauthClient->id;

        $this->action('DELETE', 'Admin\OauthClientController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkOauthClient = \App\Models\OauthClient::find($id);
        $this->assertNull($checkOauthClient);
    }

}
