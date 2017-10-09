<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CampaignUserControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CampaignUserController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CampaignUserController::class);
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
        $response = $this->action('GET', 'Admin\CampaignUserController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CampaignUserController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $campaignUser = factory(\App\Models\CampaignUser::class)->make();
        $this->action('POST', 'Admin\CampaignUserController@store', [
                '_token' => csrf_token(),
            ] + $campaignUser->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $campaignUser = factory(\App\Models\CampaignUser::class)->create();
        $this->action('GET', 'Admin\CampaignUserController@show', [$campaignUser->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $campaignUser = factory(\App\Models\CampaignUser::class)->create();

        $name = 'canceled';
        $id = $campaignUser->id;

        $campaignUser->status = 'canceled';

        $this->action('PUT', 'Admin\CampaignUserController@update', [$id], [
                '_token' => csrf_token(),
            ] + $campaignUser->toArray());
        $this->assertResponseStatus(302);

        $newCampaignUser = \App\Models\CampaignUser::find($id);
        $this->assertEquals($name, $newCampaignUser->status);
    }

    public function testDeleteModel()
    {
        $campaignUser = factory(\App\Models\CampaignUser::class)->create();

        $id = $campaignUser->id;

        $this->action('DELETE', 'Admin\CampaignUserController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCampaignUser = \App\Models\CampaignUser::find($id);
        $this->assertNull($checkCampaignUser);
    }

}
