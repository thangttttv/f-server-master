<?php namespace Tests\Models;

use App\Models\AdvertiserNotification;
use Tests\TestCase;

class AdvertiserNotificationTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\AdvertiserNotification $advertiserNotification */
        $advertiserNotification = new AdvertiserNotification();
        $this->assertNotNull($advertiserNotification);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\AdvertiserNotification $advertiserNotification */
        $advertiserNotificationModel = new AdvertiserNotification();

        $advertiserNotificationData = factory(AdvertiserNotification::class)->make();
        foreach( $advertiserNotificationData->toFillableArray() as $key => $value ) {
            $advertiserNotificationModel->$key = $value;
        }
        $advertiserNotificationModel->save();

        $this->assertNotNull(AdvertiserNotification::find($advertiserNotificationModel->id));
    }

}
