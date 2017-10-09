<?php namespace Tests\Models;

use App\Models\Advertiser;
use Tests\TestCase;

class AdvertiserTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Advertiser $advertiser */
        $advertiser = new Advertiser();
        $this->assertNotNull($advertiser);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Advertiser $advertiser */
        $advertiserModel = new Advertiser();

        $advertiserData = factory(Advertiser::class)->make();
        foreach( $advertiserData->toFillableArray() as $key => $value ) {
            $advertiserModel->$key = $value;
        }
        $advertiserModel->save();

        $this->assertNotNull(Advertiser::find($advertiserModel->id));
    }

}
