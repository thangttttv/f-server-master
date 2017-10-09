<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AreaWeightControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AreaWeightController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AreaWeightController::class);
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
        $response = $this->action('GET', 'Admin\AreaWeightController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AreaWeightController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $areaWeight = factory(\App\Models\AreaWeight::class)->make();
        $this->action('POST', 'Admin\AreaWeightController@store', [
                '_token' => csrf_token(),
            ] + $areaWeight->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $areaWeight = factory(\App\Models\AreaWeight::class)->create();
        $this->action('GET', 'Admin\AreaWeightController@show', [$areaWeight->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $areaWeight = factory(\App\Models\AreaWeight::class)->create();
        $dayOfWeek = 2;
        $id = $areaWeight->id;

        $areaWeight->day_of_week = $dayOfWeek;
        $this->action('PUT', 'Admin\AreaWeightController@update', [$id], [
                '_token' => csrf_token(),
            ] + $areaWeight->toArray());
        $this->assertResponseStatus(302);

        $newAreaWeight = \App\Models\AreaWeight::find($id);
        $this->assertEquals($dayOfWeek, $newAreaWeight->day_of_week);
    }

    public function testDeleteModel()
    {
        $areaWeight = factory(\App\Models\AreaWeight::class)->create();

        $id = $areaWeight->id;

        $this->action('DELETE', 'Admin\AreaWeightController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAreaWeight = \App\Models\AreaWeight::find($id);
        $this->assertNull($checkAreaWeight);
    }

}
