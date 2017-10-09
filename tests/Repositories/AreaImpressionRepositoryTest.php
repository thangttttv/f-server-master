<?php namespace Tests\Repositories;

use App\Models\AreaImpression;
use Tests\TestCase;

class AreaImpressionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $AreaImpressions = factory(AreaImpression::class, 3)->create();
        $AreaImpressionIds = $AreaImpressions->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $AreaImpressionsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AreaImpression::class, $AreaImpressionsCheck[0]);

        $AreaImpressionsCheck = $repository->getByIds($AreaImpressionIds);
        $this->assertEquals(3, count($AreaImpressionsCheck));
    }

    public function testFind()
    {
        $AreaImpressions = factory(AreaImpression::class, 3)->create();
        $AreaImpressionIds = $AreaImpressions->pluck('id')->toArray();

        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $AreaImpressionCheck = $repository->find($AreaImpressionIds[0]);
        $this->assertEquals($AreaImpressionIds[0], $AreaImpressionCheck->id);
    }

    public function testCreate()
    {
        $AreaImpressionData = factory(AreaImpression::class)->make();

        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $AreaImpressionCheck = $repository->create($AreaImpressionData->toFillableArray());
        $this->assertNotNull($AreaImpressionCheck);
    }

    public function testUpdate()
    {
        $AreaImpressionData = factory(AreaImpression::class)->create();

        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $AreaImpressionCheck = $repository->update($AreaImpressionData, $AreaImpressionData->toFillableArray());
        $this->assertNotNull($AreaImpressionCheck);
    }

    public function testDelete()
    {
        $AreaImpressionData = factory(AreaImpression::class)->create();

        /** @var  \App\Repositories\AreaImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AreaImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($AreaImpressionData);

        $AreaImpressionCheck = $repository->find($AreaImpressionData->id);
        $this->assertNull($AreaImpressionCheck);
    }

}
