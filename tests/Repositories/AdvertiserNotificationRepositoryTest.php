<?php namespace Tests\Repositories;

use App\Models\AdvertiserNotification;
use Tests\TestCase;

class AdvertiserNotificationRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $advertiserNotifications = factory(AdvertiserNotification::class, 3)->create();
        $advertiserNotificationIds = $advertiserNotifications->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserNotificationsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AdvertiserNotification::class, $advertiserNotificationsCheck[0]);

        $advertiserNotificationsCheck = $repository->getByIds($advertiserNotificationIds);
        $this->assertEquals(3, count($advertiserNotificationsCheck));
    }

    public function testFind()
    {
        $advertiserNotifications = factory(AdvertiserNotification::class, 3)->create();
        $advertiserNotificationIds = $advertiserNotifications->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserNotificationCheck = $repository->find($advertiserNotificationIds[0]);
        $this->assertEquals($advertiserNotificationIds[0], $advertiserNotificationCheck->id);
    }

    public function testCreate()
    {
        $advertiserNotificationData = factory(AdvertiserNotification::class)->make();

        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserNotificationCheck = $repository->create($advertiserNotificationData->toFillableArray());
        $this->assertNotNull($advertiserNotificationCheck);
    }

    public function testUpdate()
    {
        $advertiserNotificationData = factory(AdvertiserNotification::class)->create();

        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserNotificationCheck = $repository->update($advertiserNotificationData, $advertiserNotificationData->toFillableArray());
        $this->assertNotNull($advertiserNotificationCheck);
    }

    public function testDelete()
    {
        $advertiserNotificationData = factory(AdvertiserNotification::class)->create();

        /** @var  \App\Repositories\AdvertiserNotificationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserNotificationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($advertiserNotificationData);

        $advertiserNotificationCheck = $repository->find($advertiserNotificationData->id);
        $this->assertNull($advertiserNotificationCheck);
    }

}
