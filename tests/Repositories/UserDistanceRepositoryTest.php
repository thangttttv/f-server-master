<?php namespace Tests\Repositories;

use App\Models\UserDistance;
use Tests\TestCase;

class UserDistanceRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $userDistances = factory(UserDistance::class, 3)->create();
        $userDistanceIds = $userDistances->pluck('id')->toArray();

        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userDistancesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(UserDistance::class, $userDistancesCheck[0]);

        $userDistancesCheck = $repository->getByIds($userDistanceIds);
        $this->assertEquals(3, count($userDistancesCheck));
    }

    public function testFind()
    {
        $userDistances = factory(UserDistance::class, 3)->create();
        $userDistanceIds = $userDistances->pluck('id')->toArray();

        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userDistanceCheck = $repository->find($userDistanceIds[0]);
        $this->assertEquals($userDistanceIds[0], $userDistanceCheck->id);
    }

    public function testCreate()
    {
        $userDistanceData = factory(UserDistance::class)->make();

        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userDistanceCheck = $repository->create($userDistanceData->toFillableArray());
        $this->assertNotNull($userDistanceCheck);
    }

    public function testUpdate()
    {
        $userDistanceData = factory(UserDistance::class)->create();

        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userDistanceCheck = $repository->update($userDistanceData, $userDistanceData->toFillableArray());
        $this->assertNotNull($userDistanceCheck);
    }

    public function testDelete()
    {
        $userDistanceData = factory(UserDistance::class)->create();

        /** @var  \App\Repositories\UserDistanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserDistanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($userDistanceData);

        $userDistanceCheck = $repository->find($userDistanceData->id);
        $this->assertNull($userDistanceCheck);
    }

}
