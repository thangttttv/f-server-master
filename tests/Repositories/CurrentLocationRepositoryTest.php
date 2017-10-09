<?php namespace Tests\Repositories;

use App\Models\CurrentLocation;
use Tests\TestCase;

class CurrentLocationRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $currentLocations = factory(CurrentLocation::class, 3)->create();
        $currentLocationIds = $currentLocations->pluck('id')->toArray();

        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $currentLocationsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CurrentLocation::class, $currentLocationsCheck[0]);

        $currentLocationsCheck = $repository->getByIds($currentLocationIds);
        $this->assertEquals(3, count($currentLocationsCheck));
    }

    public function testFind()
    {
        $currentLocations = factory(CurrentLocation::class, 3)->create();
        $currentLocationIds = $currentLocations->pluck('id')->toArray();

        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $currentLocationCheck = $repository->find($currentLocationIds[0]);
        $this->assertEquals($currentLocationIds[0], $currentLocationCheck->id);
    }

    public function testCreate()
    {
        $currentLocationData = factory(CurrentLocation::class)->make();

        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $currentLocationCheck = $repository->create($currentLocationData->toFillableArray());
        $this->assertNotNull($currentLocationCheck);
    }

    public function testUpdate()
    {
        $currentLocationData = factory(CurrentLocation::class)->create();

        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $currentLocationCheck = $repository->update($currentLocationData, $currentLocationData->toFillableArray());
        $this->assertNotNull($currentLocationCheck);
    }

    public function testDelete()
    {
        $currentLocationData = factory(CurrentLocation::class)->create();

        /** @var  \App\Repositories\CurrentLocationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CurrentLocationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($currentLocationData);

        $currentLocationCheck = $repository->find($currentLocationData->id);
        $this->assertNull($currentLocationCheck);
    }

}
