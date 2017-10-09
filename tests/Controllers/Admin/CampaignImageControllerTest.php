<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CampaignImageControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CampaignImageController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CampaignImageController::class);
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
        $response = $this->action('GET', 'Admin\CampaignImageController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CampaignImageController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $campaignImage = factory(\App\Models\CampaignImage::class)->make();
        $campaign = factory(\App\Models\Campaign::class)->create();
        $campaignImage->campaign_id = $campaign->id;
        $this->action('POST', 'Admin\CampaignImageController@store', [
                '_token' => csrf_token(),
            ] + $campaignImage->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $campaignImage = factory(\App\Models\CampaignImage::class)->create();
        $this->action('GET', 'Admin\CampaignImageController@show', [$campaignImage->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $campaignImage = factory(\App\Models\CampaignImage::class)->create();
        $name = $faker->name;
        $id = $campaignImage->id;

        $campaignImage->currency_code = $name;
        $campaign = factory(\App\Models\Campaign::class)->create();
        $campaignImage->campaign_id = $campaign->id;
        $this->action('PUT', 'Admin\CampaignImageController@update', [$id], [
                '_token' => csrf_token(),
            ] + $campaignImage->toArray());
        $this->assertResponseStatus(302);

        $newCampaignImage = \App\Models\CampaignImage::find($id);
        $this->assertEquals($name, $newCampaignImage->currency_code);
    }

    public function testDeleteModel()
    {
        $campaignImage = factory(\App\Models\CampaignImage::class)->create();

        $id = $campaignImage->id;

        $this->action('DELETE', 'Admin\CampaignImageController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCampaignImage = \App\Models\CampaignImage::find($id);
        $this->assertNull($checkCampaignImage);
    }

}
