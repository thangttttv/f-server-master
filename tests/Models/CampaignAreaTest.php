<?php namespace Tests\Models;

use App\Models\CampaignArea;
use Tests\TestCase;

class CampaignAreaTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CampaignArea $campaignArea */
        $campaignArea = new CampaignArea();
        $this->assertNotNull($campaignArea);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CampaignArea $campaignArea */
        $campaignAreaModel = new CampaignArea();

        $campaignAreaData = factory(CampaignArea::class)->make();
        foreach( $campaignAreaData->toFillableArray() as $key => $value ) {
            $campaignAreaModel->$key = $value;
        }
        $campaignAreaModel->save();

        $this->assertNotNull(CampaignArea::find($campaignAreaModel->id));
    }

}
