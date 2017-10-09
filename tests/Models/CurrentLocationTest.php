<?php namespace Tests\Models;

use App\Models\CurrentLocation;
use Tests\TestCase;

class CurrentLocationTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CurrentLocation $currentLocation */
        $currentLocation = new CurrentLocation();
        $this->assertNotNull($currentLocation);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CurrentLocation $currentLocation */
        $currentLocationModel = new CurrentLocation();

        $currentLocationData = factory(CurrentLocation::class)->make();
        foreach( $currentLocationData->toFillableArray() as $key => $value ) {
            $currentLocationModel->$key = $value;
        }
        $currentLocationModel->save();

        $this->assertNotNull(CurrentLocation::find($currentLocationModel->id));
    }

}
