<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class BankControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\BankController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\BankController::class);
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
        $response = $this->action('GET', 'Admin\BankController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\BankController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $bank = factory(\App\Models\Bank::class)->make();
        $this->action('POST', 'Admin\BankController@store', [
                '_token' => csrf_token(),
            ] + $bank->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $bank = factory(\App\Models\Bank::class)->create();
        $this->action('GET', 'Admin\BankController@show', [$bank->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $bank = factory(\App\Models\Bank::class)->create();

        $name = $faker->name;
        $id = $bank->id;

        $bank->name = $name;

        $this->action('PUT', 'Admin\BankController@update', [$id], [
                '_token' => csrf_token(),
            ] + $bank->toArray());
        $this->assertResponseStatus(302);

        $newBank = \App\Models\Bank::find($id);
        $this->assertEquals($name, $newBank->name);
    }

    public function testDeleteModel()
    {
        $bank = factory(\App\Models\Bank::class)->create();

        $id = $bank->id;

        $this->action('DELETE', 'Admin\BankController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkBank = \App\Models\Bank::find($id);
        $this->assertNull($checkBank);
    }

}
