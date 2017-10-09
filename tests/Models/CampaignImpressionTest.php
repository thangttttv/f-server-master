<?php namespace Tests\Models;

use App\Models\CampaignImpression;
use Tests\TestCase;

class CampaignImpressionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CampaignImpression $campaignImpression */
        $campaignImpression = new CampaignImpression();
        $this->assertNotNull($campaignImpression);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CampaignImpression $campaignImpression */
        $campaignImpressionModel = new CampaignImpression();

        $campaignImpressionData = factory(CampaignImpression::class)->make();
        foreach( $campaignImpressionData->toFillableArray() as $key => $value ) {
            $campaignImpressionModel->$key = $value;
        }
        $campaignImpressionModel->save();

        $this->assertNotNull(CampaignImpression::find($campaignImpressionModel->id));
    }

}
