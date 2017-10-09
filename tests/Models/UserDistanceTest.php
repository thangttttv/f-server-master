<?php namespace Tests\Models;

use App\Models\UserDistance;
use Tests\TestCase;

class UserDistanceTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\UserDistance $userDistance */
        $userDistance = new UserDistance();
        $this->assertNotNull($userDistance);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\UserDistance $userDistance */
        $userDistanceModel = new UserDistance();

        $userDistanceData = factory(UserDistance::class)->make();
        foreach( $userDistanceData->toFillableArray() as $key => $value ) {
            $userDistanceModel->$key = $value;
        }
        $userDistanceModel->save();

        $this->assertNotNull(UserDistance::find($userDistanceModel->id));
    }

}
