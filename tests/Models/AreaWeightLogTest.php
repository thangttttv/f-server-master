<?php namespace Tests\Models;

use App\Models\AreaWeightLog;
use Tests\TestCase;

class AreaWeightLogTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\AreaWeightLog $weightLog */
        $weightLog = new AreaWeightLog();
        $this->assertNotNull($weightLog);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\AreaWeightLog $weightLog */
        $weightLogModel = new AreaWeightLog();

        $weightLogData = factory(AreaWeightLog::class)->make();
        foreach( $weightLogData->toFillableArray() as $key => $value ) {
            $weightLogModel->$key = $value;
        }
        $weightLogModel->save();

        $this->assertNotNull(AreaWeightLog::find($weightLogModel->id));
    }

}
