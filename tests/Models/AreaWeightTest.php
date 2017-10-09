<?php namespace Tests\Models;

use App\Models\AreaWeight;
use Tests\TestCase;

class AreaWeightTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\AreaWeight $areaWeight */
        $areaWeight = new AreaWeight();
        $this->assertNotNull($areaWeight);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\AreaWeight $areaWeight */
        $areaWeightModel = new AreaWeight();

        $areaWeightData = factory(AreaWeight::class)->make();
        foreach( $areaWeightData->toFillableArray() as $key => $value ) {
            $areaWeightModel->$key = $value;
        }
        $areaWeightModel->save();

        $this->assertNotNull(AreaWeight::find($areaWeightModel->id));
    }

}
