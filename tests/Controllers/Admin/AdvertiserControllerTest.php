<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AdvertiserControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AdvertiserController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AdvertiserController::class);
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
        $response = $this->action('GET', 'Admin\AdvertiserController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AdvertiserController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $advertiser = factory(\App\Models\Advertiser::class)->make();
        $this->action('POST', 'Admin\AdvertiserController@store', [
                '_token' => csrf_token(),
            ] + $advertiser->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $advertiser = factory(\App\Models\Advertiser::class)->create();
        $this->action('GET', 'Admin\AdvertiserController@show', [$advertiser->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $advertiser = factory(\App\Models\Advertiser::class)->create();

        $name = $faker->name;
        $id = $advertiser->id;

        $advertiser->name = $name;

        $this->action('PUT', 'Admin\AdvertiserController@update', [$id], [
                '_token' => csrf_token(),
            ] + $advertiser->toArray());
        $this->assertResponseStatus(302);

        $newAdvertiser = \App\Models\Advertiser::find($id);
        $this->assertEquals($name, $newAdvertiser->name);
    }

    public function testDeleteModel()
    {
        $advertiser = factory(\App\Models\Advertiser::class)->create();

        $id = $advertiser->id;

        $this->action('DELETE', 'Admin\AdvertiserController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAdvertiser = \App\Models\Advertiser::find($id);
        $this->assertNull($checkAdvertiser);
    }

}
