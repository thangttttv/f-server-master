<?php namespace Tests\Models;

use App\Models\CampaignUser;
use Tests\TestCase;

class CampaignUserTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CampaignUser $campaignUser */
        $campaignUser = new CampaignUser();
        $this->assertNotNull($campaignUser);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CampaignUser $campaignUser */
        $campaignUserModel = new CampaignUser();

        $campaignUserData = factory(CampaignUser::class)->make();
        foreach( $campaignUserData->toFillableArray() as $key => $value ) {
            $campaignUserModel->$key = $value;
        }
        $campaignUserModel->save();

        $this->assertNotNull(CampaignUser::find($campaignUserModel->id));
    }

}
