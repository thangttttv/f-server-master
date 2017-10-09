<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class PaymentLogControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\PaymentLogController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\PaymentLogController::class);
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
        $response = $this->action('GET', 'Admin\PaymentLogController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\PaymentLogController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $paymentLog = factory(\App\Models\PaymentLog::class)->make();
        $this->action('POST', 'Admin\PaymentLogController@store', [
                '_token' => csrf_token(),
            ] + $paymentLog->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $paymentLog = factory(\App\Models\PaymentLog::class)->create();
        $this->action('GET', 'Admin\PaymentLogController@show', [$paymentLog->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $paymentLog = factory(\App\Models\PaymentLog::class)->create();

        $name = $faker->name;
        $id = $paymentLog->id;

        $paymentLog->note = $name;

        $this->action('PUT', 'Admin\PaymentLogController@update', [$id], [
                '_token' => csrf_token(),
            ] + $paymentLog->toArray());
        $this->assertResponseStatus(302);

        $newPaymentLog = \App\Models\PaymentLog::find($id);
        $this->assertEquals($name, $newPaymentLog->note);
    }

    public function testDeleteModel()
    {
        $paymentLog = factory(\App\Models\PaymentLog::class)->create();

        $id = $paymentLog->id;

        $this->action('DELETE', 'Admin\PaymentLogController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkPaymentLog = \App\Models\PaymentLog::find($id);
        $this->assertNull($checkPaymentLog);
    }

}
