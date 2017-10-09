<?php namespace Tests\Repositories;

use App\Models\CampaignImpression;
use Tests\TestCase;

class CampaignImpressionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $campaignImpressions = factory(CampaignImpression::class, 3)->create();
        $campaignImpressionIds = $campaignImpressions->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImpressionsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CampaignImpression::class, $campaignImpressionsCheck[0]);

        $campaignImpressionsCheck = $repository->getByIds($campaignImpressionIds);
        $this->assertEquals(3, count($campaignImpressionsCheck));
    }

    public function testFind()
    {
        $campaignImpressions = factory(CampaignImpression::class, 3)->create();
        $campaignImpressionIds = $campaignImpressions->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImpressionCheck = $repository->find($campaignImpressionIds[0]);
        $this->assertEquals($campaignImpressionIds[0], $campaignImpressionCheck->id);
    }

    public function testCreate()
    {
        $campaignImpressionData = factory(CampaignImpression::class)->make();

        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImpressionCheck = $repository->create($campaignImpressionData->toFillableArray());
        $this->assertNotNull($campaignImpressionCheck);
    }

    public function testUpdate()
    {
        $campaignImpressionData = factory(CampaignImpression::class)->create();

        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImpressionCheck = $repository->update($campaignImpressionData, $campaignImpressionData->toFillableArray());
        $this->assertNotNull($campaignImpressionCheck);
    }

    public function testDelete()
    {
        $campaignImpressionData = factory(CampaignImpression::class)->create();

        /** @var  \App\Repositories\CampaignImpressionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImpressionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($campaignImpressionData);

        $campaignImpressionCheck = $repository->find($campaignImpressionData->id);
        $this->assertNull($campaignImpressionCheck);
    }

}
