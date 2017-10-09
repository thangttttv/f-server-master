<?php namespace Tests\Repositories;

use App\Models\CampaignImage;
use Tests\TestCase;

class CampaignImageRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $campaignImages = factory(CampaignImage::class, 3)->create();
        $campaignImageIds = $campaignImages->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImagesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CampaignImage::class, $campaignImagesCheck[0]);

        $campaignImagesCheck = $repository->getByIds($campaignImageIds);
        $this->assertEquals(3, count($campaignImagesCheck));
    }

    public function testFind()
    {
        $campaignImages = factory(CampaignImage::class, 3)->create();
        $campaignImageIds = $campaignImages->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImageCheck = $repository->find($campaignImageIds[0]);
        $this->assertEquals($campaignImageIds[0], $campaignImageCheck->id);
    }

    public function testCreate()
    {
        $campaignImageData = factory(CampaignImage::class)->make();

        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImageCheck = $repository->create($campaignImageData->toFillableArray());
        $this->assertNotNull($campaignImageCheck);
    }

    public function testUpdate()
    {
        $campaignImageData = factory(CampaignImage::class)->create();

        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignImageCheck = $repository->update($campaignImageData, $campaignImageData->toFillableArray());
        $this->assertNotNull($campaignImageCheck);
    }

    public function testDelete()
    {
        $campaignImageData = factory(CampaignImage::class)->create();

        /** @var  \App\Repositories\CampaignImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($campaignImageData);

        $campaignImageCheck = $repository->find($campaignImageData->id);
        $this->assertNull($campaignImageCheck);
    }

}
