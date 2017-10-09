<?php namespace Tests\Repositories;

use App\Models\AreaWeight;
use Tests\TestCase;

class AreaWeightRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $areaWeights = factory(AreaWeight::class, 3)->create();
        $areaWeightIds = $areaWeights->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaWeightsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AreaWeight::class, $areaWeightsCheck[0]);

        $areaWeightsCheck = $repository->getByIds($areaWeightIds);
        $this->assertEquals(3, count($areaWeightsCheck));
    }

    public function testFind()
    {
        $areaWeights = factory(AreaWeight::class, 3)->create();
        $areaWeightIds = $areaWeights->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaWeightCheck = $repository->find($areaWeightIds[0]);
        $this->assertEquals($areaWeightIds[0], $areaWeightCheck->id);
    }

    public function testCreate()
    {
        $areaWeightData = factory(AreaWeight::class)->make();

        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaWeightCheck = $repository->create($areaWeightData->toFillableArray());
        $this->assertNotNull($areaWeightCheck);
    }

    public function testUpdate()
    {
        $areaWeightData = factory(AreaWeight::class)->create();

        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaWeightCheck = $repository->update($areaWeightData, $areaWeightData->toFillableArray());
        $this->assertNotNull($areaWeightCheck);
    }

    public function testDelete()
    {
        $areaWeightData = factory(AreaWeight::class)->create();

        /** @var  \App\Repositories\AreaWeightRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaWeightRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($areaWeightData);

        $areaWeightCheck = $repository->find($areaWeightData->id);
        $this->assertNull($areaWeightCheck);
    }

}
