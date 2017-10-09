<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CityControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CityController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CityController::class);
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
        $response = $this->action('GET', 'Admin\CityController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CityController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $city = factory(\App\Models\City::class)->make();
        $this->action('POST', 'Admin\CityController@store', [
                '_token' => csrf_token(),
            ] + $city->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $city = factory(\App\Models\City::class)->create();
        $this->action('GET', 'Admin\CityController@show', [$city->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $city = factory(\App\Models\City::class)->create();

        $name = $faker->name;
        $id = $city->id;

        $city->name_en = $name;

        $this->action('PUT', 'Admin\CityController@update', [$id], [
                '_token' => csrf_token(),
            ] + $city->toArray());

        $this->assertResponseStatus(302);

        $newCity = \App\Models\City::find($id);
        $this->assertEquals($name, $newCity->name_en);
    }

    public function testDeleteModel()
    {
        $city = factory(\App\Models\City::class)->create();

        $id = $city->id;

        $this->action('DELETE', 'Admin\CityController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCity = \App\Models\City::find($id);
        $this->assertNull($checkCity);
    }

}
