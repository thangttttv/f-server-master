<?php namespace Tests\Models;

use App\Models\AreaImpression;
use Tests\TestCase;

class AreaImpressionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\AreaImpression $areaImpression */
        $areaImpression = new AreaImpression();
        $this->assertNotNull($areaImpression);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\AreaImpression $areaImpression */
        $areaImpressionModel = new AreaImpression();

        $areaImpressionData = factory(AreaImpression::class)->make();
        foreach( $areaImpressionData->toFillableArray() as $key => $value ) {
            $areaImpressionModel->$key = $value;
        }
        $areaImpressionModel->save();

        $this->assertNotNull(AreaImpression::find($areaImpressionModel->id));
    }

}
