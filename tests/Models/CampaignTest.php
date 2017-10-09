<?php namespace Tests\Models;

use App\Models\Campaign;
use Tests\TestCase;

class CampaignTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Campaign $campaign */
        $campaign = new Campaign();
        $this->assertNotNull($campaign);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Campaign $campaign */
        $campaignModel = new Campaign();

        $campaignData = factory(Campaign::class)->make();
        foreach( $campaignData->toFillableArray() as $key => $value ) {
            $campaignModel->$key = $value;
        }
        $campaignModel->save();

        $this->assertNotNull(Campaign::find($campaignModel->id));
    }

}
