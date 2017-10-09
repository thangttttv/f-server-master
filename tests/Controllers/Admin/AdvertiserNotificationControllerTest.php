<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AdvertiserNotificationControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AdvertiserNotificationController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AdvertiserNotificationController::class);
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
        $response = $this->action('GET', 'Admin\AdvertiserNotificationController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AdvertiserNotificationController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $advertiserNotification = factory(\App\Models\AdvertiserNotification::class)->make();
        $this->action('POST', 'Admin\AdvertiserNotificationController@store', [
                '_token' => csrf_token(),
            ] + $advertiserNotification->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $advertiserNotification = factory(\App\Models\AdvertiserNotification::class)->create();
        $this->action('GET', 'Admin\AdvertiserNotificationController@show', [$advertiserNotification->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $advertiserNotification = factory(\App\Models\AdvertiserNotification::class)->create();

        $text = $faker->sentence();
        $id = $advertiserNotification->id;

        $advertiserNotification->content = $text;

        $this->action('PUT', 'Admin\AdvertiserNotificationController@update', [$id], [
                '_token' => csrf_token(),
            ] + $advertiserNotification->toFillableArray());
        $this->assertResponseStatus(302);

        $newAdvertiserNotification = \App\Models\AdvertiserNotification::find($id);
        $this->assertEquals($text, $newAdvertiserNotification->content);
    }

    public function testDeleteModel()
    {
        $advertiserNotification = factory(\App\Models\AdvertiserNotification::class)->create();

        $id = $advertiserNotification->id;

        $this->action('DELETE', 'Admin\AdvertiserNotificationController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAdvertiserNotification = \App\Models\AdvertiserNotification::find($id);
        $this->assertNull($checkAdvertiserNotification);
    }

}
