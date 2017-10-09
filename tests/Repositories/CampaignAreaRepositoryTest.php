<?php namespace Tests\Repositories;

use App\Models\CampaignArea;
use Tests\TestCase;

class CampaignAreaRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $campaignAreas = factory(CampaignArea::class, 3)->create();
        $campaignAreaIds = $campaignAreas->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignAreasCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CampaignArea::class, $campaignAreasCheck[0]);

        $campaignAreasCheck = $repository->getByIds($campaignAreaIds);
        $this->assertEquals(3, count($campaignAreasCheck));
    }

    public function testFind()
    {
        $campaignAreas = factory(CampaignArea::class, 3)->create();
        $campaignAreaIds = $campaignAreas->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignAreaCheck = $repository->find($campaignAreaIds[0]);
        $this->assertEquals($campaignAreaIds[0], $campaignAreaCheck->id);
    }

    public function testCreate()
    {
        $campaignAreaData = factory(CampaignArea::class)->make();

        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignAreaCheck = $repository->create($campaignAreaData->toFillableArray());
        $this->assertNotNull($campaignAreaCheck);
    }

    public function testUpdate()
    {
        $campaignAreaData = factory(CampaignArea::class)->create();

        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignAreaCheck = $repository->update($campaignAreaData, $campaignAreaData->toFillableArray());
        $this->assertNotNull($campaignAreaCheck);
    }

    public function testDelete()
    {
        $campaignAreaData = factory(CampaignArea::class)->create();

        /** @var  \App\Repositories\CampaignAreaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignAreaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($campaignAreaData);

        $campaignAreaCheck = $repository->find($campaignAreaData->id);
        $this->assertNull($campaignAreaCheck);
    }

}
