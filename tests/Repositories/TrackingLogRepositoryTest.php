<?php namespace Tests\Repositories;

use App\Models\TrackingLog;
use Tests\TestCase;

class TrackingLogRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $trackings = factory(TrackingLog::class, 3)->create();
        $trackingIds = $trackings->pluck('id')->toArray();

        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $trackingsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(TrackingLog::class, $trackingsCheck[0]);

        $trackingsCheck = $repository->getByIds($trackingIds);
        $this->assertEquals(3, count($trackingsCheck));
    }

    public function testFind()
    {
        $trackings = factory(TrackingLog::class, 3)->create();
        $trackingIds = $trackings->pluck('id')->toArray();

        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $trackingCheck = $repository->find($trackingIds[0]);
        $this->assertEquals($trackingIds[0], $trackingCheck->id);
    }

    public function testCreate()
    {
        $trackingData = factory(TrackingLog::class)->make();

        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $trackingCheck = $repository->create($trackingData->toFillableArray());
        $this->assertNotNull($trackingCheck);
    }

    public function testUpdate()
    {
        $trackingData = factory(TrackingLog::class)->create();

        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $trackingCheck = $repository->update($trackingData, $trackingData->toFillableArray());
        $this->assertNotNull($trackingCheck);
    }

    public function testDelete()
    {
        $trackingData = factory(TrackingLog::class)->create();

        /** @var  \App\Repositories\TrackingLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TrackingLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($trackingData);

        $trackingCheck = $repository->find($trackingData->id);
        $this->assertNull($trackingCheck);
    }

}
