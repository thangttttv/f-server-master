<?php namespace Tests\Repositories;

use App\Models\Advertiser;
use Tests\TestCase;

class AdvertiserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $advertisers = factory(Advertiser::class, 3)->create();
        $advertiserIds = $advertisers->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertisersCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Advertiser::class, $advertisersCheck[0]);

        $advertisersCheck = $repository->getByIds($advertiserIds);
        $this->assertEquals(3, count($advertisersCheck));
    }

    public function testFind()
    {
        $advertisers = factory(Advertiser::class, 3)->create();
        $advertiserIds = $advertisers->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserCheck = $repository->find($advertiserIds[0]);
        $this->assertEquals($advertiserIds[0], $advertiserCheck->id);
    }

    public function testCreate()
    {
        $advertiserData = factory(Advertiser::class)->make();

        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserCheck = $repository->create($advertiserData->toFillableArray());
        $this->assertNotNull($advertiserCheck);
    }

    public function testUpdate()
    {
        $advertiserData = factory(Advertiser::class)->create();

        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertiserCheck = $repository->update($advertiserData, $advertiserData->toFillableArray());
        $this->assertNotNull($advertiserCheck);
    }

    public function testDelete()
    {
        $advertiserData = factory(Advertiser::class)->create();

        /** @var  \App\Repositories\AdvertiserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertiserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($advertiserData);

        $advertiserCheck = $repository->find($advertiserData->id);
        $this->assertNull($advertiserCheck);
    }

}
