<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AreaWeightLogControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AreaWeightLogController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AreaWeightLogController::class);
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
        $response = $this->action('GET', 'Admin\AreaWeightLogController@index');
        $this->assertResponseOk();
    }

}
