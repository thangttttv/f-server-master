<?php namespace Tests\Models;

use App\Models\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Country $country */
        $country = new Country();
        $this->assertNotNull($country);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Country $country */
        $countryModel = new Country();

        $countryData = factory(Country::class)->make();
        foreach( $countryData->toFillableArray() as $key => $value ) {
            $countryModel->$key = $value;
        }
        $countryModel->save();

        $this->assertNotNull(Country::find($countryModel->id));
    }

}
