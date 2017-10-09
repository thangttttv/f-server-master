<?php namespace Tests\Models;

use App\Models\TrackingLog;
use Tests\TestCase;

class TrackingLogTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\TrackingLog $TrackingLog */
        $TrackingLog = new TrackingLog();
        $this->assertNotNull($TrackingLog);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\TrackingLog $TrackingLog */
        $TrackingLogModel = new TrackingLog();

        $TrackingLogData = factory(TrackingLog::class)->make();
        foreach( $TrackingLogData->toFillableArray() as $key => $value ) {
            $TrackingLogModel->$key = $value;
        }
        $TrackingLogModel->save();

        $this->assertNotNull(TrackingLog::find($TrackingLogModel->id));
    }

}
