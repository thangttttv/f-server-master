<?php namespace Tests\Repositories;

use App\Models\Area;
use Tests\TestCase;

class AreaRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $areas = factory(Area::class, 3)->create();
        $areaIds = $areas->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areasCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Area::class, $areasCheck[0]);

        $areasCheck = $repository->getByIds($areaIds);
        $this->assertEquals(3, count($areasCheck));
    }

    public function testFind()
    {
        $areas = factory(Area::class, 3)->create();
        $areaIds = $areas->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaCheck = $repository->find($areaIds[0]);
        $this->assertEquals($areaIds[0], $areaCheck->id);
    }

    public function testCreate()
    {
        $areaData = factory(Area::class)->make();

        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaCheck = $repository->create($areaData->toFillableArray());
        $this->assertNotNull($areaCheck);
    }

    public function testUpdate()
    {
        $areaData = factory(Area::class)->create();

        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $areaCheck = $repository->update($areaData, $areaData->toFillableArray());
        $this->assertNotNull($areaCheck);
    }

    public function testDelete()
    {
        $areaData = factory(Area::class)->create();

        /** @var  \App\Repositories\AreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($areaData);

        $areaCheck = $repository->find($areaData->id);
        $this->assertNull($areaCheck);
    }

}
