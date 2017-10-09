<?php namespace Tests\Repositories;

use App\Models\AreaWeightLog;
use Tests\TestCase;

class AreaWeightLogRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $weightLogs = factory(AreaWeightLog::class, 3)->create();
        $weightLogIds = $weightLogs->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $weightLogsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AreaWeightLog::class, $weightLogsCheck[0]);

        $weightLogsCheck = $repository->getByIds($weightLogIds);
        $this->assertEquals(3, count($weightLogsCheck));
    }

    public function testFind()
    {
        $weightLogs = factory(AreaWeightLog::class, 3)->create();
        $weightLogIds = $weightLogs->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $weightLogCheck = $repository->find($weightLogIds[0]);
        $this->assertEquals($weightLogIds[0], $weightLogCheck->id);
    }

    public function testCreate()
    {
        $weightLogData = factory(AreaWeightLog::class)->make();

        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $weightLogCheck = $repository->create($weightLogData->toFillableArray());
        $this->assertNotNull($weightLogCheck);
    }

    public function testUpdate()
    {
        $weightLogData = factory(AreaWeightLog::class)->create();

        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $weightLogCheck = $repository->update($weightLogData, $weightLogData->toFillableArray());
        $this->assertNotNull($weightLogCheck);
    }

    public function testDelete()
    {
        $weightLogData = factory(AreaWeightLog::class)->create();

        /** @var  \App\Repositories\AreaWeightLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($weightLogData);

        $weightLogCheck = $repository->find($weightLogData->id);
        $this->assertNull($weightLogCheck);
    }

}
