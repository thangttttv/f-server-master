<?php namespace Tests\Repositories;

use App\Models\Campaign;
use Tests\TestCase;

class CampaignRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $campaigns = factory(Campaign::class, 3)->create();
        $campaignIds = $campaigns->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Campaign::class, $campaignsCheck[0]);

        $campaignsCheck = $repository->getByIds($campaignIds);
        $this->assertEquals(3, count($campaignsCheck));
    }

    public function testFind()
    {
        $campaigns = factory(Campaign::class, 3)->create();
        $campaignIds = $campaigns->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignCheck = $repository->find($campaignIds[0]);
        $this->assertEquals($campaignIds[0], $campaignCheck->id);
    }

    public function testCreate()
    {
        $campaignData = factory(Campaign::class)->make();

        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignCheck = $repository->create($campaignData->toFillableArray());
        $this->assertNotNull($campaignCheck);
    }

    public function testUpdate()
    {
        $campaignData = factory(Campaign::class)->create();

        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignCheck = $repository->update($campaignData, $campaignData->toFillableArray());
        $this->assertNotNull($campaignCheck);
    }

    public function testDelete()
    {
        $campaignData = factory(Campaign::class)->create();

        /** @var  \App\Repositories\CampaignRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($campaignData);

        $campaignCheck = $repository->find($campaignData->id);
        $this->assertNull($campaignCheck);
    }

}
