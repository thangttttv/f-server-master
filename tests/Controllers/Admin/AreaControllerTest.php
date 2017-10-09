<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AreaControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AreaController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AreaController::class);
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
        $response = $this->action('GET', 'Admin\AreaController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AreaController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $area = factory(\App\Models\Area::class)->make();
        $this->action('POST', 'Admin\AreaController@store', [
                '_token' => csrf_token(),
            ] + $area->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $area = factory(\App\Models\Area::class)->create();
        $this->action('GET', 'Admin\AreaController@show', [$area->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        /** @var \App\Models\Area $area */
        $area = factory(\App\Models\Area::class)->create();

        $name = $faker->name;
        $id = $area->id;

        $area->name_en = $name;

        $this->action('PUT', 'Admin\AreaController@update', [$id], [
                '_token' => csrf_token(),
            ] + $area->toArray());

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo(action('Admin\AreaController@show', [$id]));

        $newArea = \App\Models\Area::find($id);
        $this->assertEquals($name, $newArea->name_en);
    }

    public function testDeleteModel()
    {
        $area = factory(\App\Models\Area::class)->create();

        $id = $area->id;

        $this->action('DELETE', 'Admin\AreaController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkArea = \App\Models\Area::find($id);
        $this->assertNull($checkArea);
    }

}
