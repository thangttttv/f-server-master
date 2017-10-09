<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CampaignControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CampaignController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CampaignController::class);
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
        $response = $this->action('GET', 'Admin\CampaignController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CampaignController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $campaign = factory(\App\Models\Campaign::class)->make();
        $this->action('POST', 'Admin\CampaignController@store', [
                '_token' => csrf_token(),
            ] + $campaign->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $campaign = factory(\App\Models\Campaign::class)->create();
        $this->action('GET', 'Admin\CampaignController@show', [$campaign->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $campaign = factory(\App\Models\Campaign::class)->create();

        $name = $faker->name;
        $id = $campaign->id;

        $campaign->name = $name;

        $this->action('PUT', 'Admin\CampaignController@update', [$id], [
                '_token' => csrf_token(),
            ] + $campaign->toArray());
        $this->assertResponseStatus(302);

        $newCampaign = \App\Models\Campaign::find($id);
        $this->assertEquals($name, $newCampaign->name);
    }

    public function testDeleteModel()
    {
        $campaign = factory(\App\Models\Campaign::class)->create();

        $id = $campaign->id;

        $this->action('DELETE', 'Admin\CampaignController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCampaign = \App\Models\Campaign::find($id);
        $this->assertNull($checkCampaign);
    }

}
