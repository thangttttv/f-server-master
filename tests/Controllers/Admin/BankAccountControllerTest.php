<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class BankAccountControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\BankAccountController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\BankAccountController::class);
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
        $response = $this->action('GET', 'Admin\BankAccountController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\BankAccountController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $bankAccount = factory(\App\Models\BankAccount::class)->make();
        $this->action('POST', 'Admin\BankAccountController@store', [
                '_token' => csrf_token(),
            ] + $bankAccount->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $bankAccount = factory(\App\Models\BankAccount::class)->create();
        $this->action('GET', 'Admin\BankAccountController@show', [$bankAccount->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $bankAccount = factory(\App\Models\BankAccount::class)->create();

        $name = $faker->name;
        $id = $bankAccount->id;

        $bankAccount->branch_name = $name;

        $this->action('PUT', 'Admin\BankAccountController@update', [$id], [
                '_token' => csrf_token(),
            ] + $bankAccount->toArray());
        $this->assertResponseStatus(302);

        $newBankAccount = \App\Models\BankAccount::find($id);
        $this->assertEquals($name, $newBankAccount->branch_name);
    }

    public function testDeleteModel()
    {
        $bankAccount = factory(\App\Models\BankAccount::class)->create();

        $id = $bankAccount->id;

        $this->action('DELETE', 'Admin\BankAccountController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkBankAccount = \App\Models\BankAccount::find($id);
        $this->assertNull($checkBankAccount);
    }

}
