<?php namespace Tests\Models;

use App\Models\CampaignImage;
use Tests\TestCase;

class CampaignImageTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CampaignImage $campaignImage */
        $campaignImage = new CampaignImage();
        $this->assertNotNull($campaignImage);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CampaignImage $campaignImage */
        $campaignImageModel = new CampaignImage();

        $campaignImageData = factory(CampaignImage::class)->make();
        foreach( $campaignImageData->toFillableArray() as $key => $value ) {
            $campaignImageModel->$key = $value;
        }
        $campaignImageModel->save();

        $this->assertNotNull(CampaignImage::find($campaignImageModel->id));
    }

}
