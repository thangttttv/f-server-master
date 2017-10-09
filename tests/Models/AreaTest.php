<?php namespace Tests\Models;

use App\Models\Area;
use Tests\TestCase;

class AreaTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Area $area */
        $area = new Area();
        $this->assertNotNull($area);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Area $area */
        $areaModel = new Area();

        $areaData = factory(Area::class)->make();
        foreach( $areaData->toFillableArray() as $key => $value ) {
            $areaModel->$key = $value;
        }
        $areaModel->save();

        $this->assertNotNull(Area::find($areaModel->id));
    }

}
