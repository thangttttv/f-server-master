<?php namespace Tests\Models;

use App\Models\City;
use Tests\TestCase;

class CityTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\City $city */
        $city = new City();
        $this->assertNotNull($city);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\City $city */
        $cityModel = new City();

        $cityData = factory(City::class)->make();
        foreach( $cityData->toFillableArray() as $key => $value ) {
            $cityModel->$key = $value;
        }
        $cityModel->save();

        $this->assertNotNull(City::find($cityModel->id));
    }

}
