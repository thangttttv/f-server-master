<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CountryControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CountryController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CountryController::class);
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
        $response = $this->action('GET', 'Admin\CountryController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CountryController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $country = factory(\App\Models\Country::class)->make();
        $this->action('POST', 'Admin\CountryController@store', [
                '_token' => csrf_token(),
            ] + $country->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $country = factory(\App\Models\Country::class)->create();
        $this->action('GET', 'Admin\CountryController@show', [$country->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $country = factory(\App\Models\Country::class)->create();

        $name = $faker->name;
        $id = $country->id;

        $country->name_en = $name;

        $this->action('PUT', 'Admin\CountryController@update', [$id], [
                '_token' => csrf_token(),
            ] + $country->toArray());
        $this->assertResponseStatus(302);

        $newCountry = \App\Models\Country::find($id);
        $this->assertEquals($name, $newCountry->name_en);
    }

    public function testDeleteModel()
    {
        $country = factory(\App\Models\Country::class)->create();

        $id = $country->id;

        $this->action('DELETE', 'Admin\CountryController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCountry = \App\Models\Country::find($id);
        $this->assertNull($checkCountry);
    }

}
