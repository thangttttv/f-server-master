<?php namespace Tests\Repositories;

use App\Models\CampaignUser;
use Tests\TestCase;

class CampaignUserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $campaignUsers = factory(CampaignUser::class, 3)->create();
        $campaignUserIds = $campaignUsers->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignUsersCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CampaignUser::class, $campaignUsersCheck[0]);

        $campaignUsersCheck = $repository->getByIds($campaignUserIds);
        $this->assertEquals(3, count($campaignUsersCheck));
    }

    public function testFind()
    {
        $campaignUsers = factory(CampaignUser::class, 3)->create();
        $campaignUserIds = $campaignUsers->pluck('id')->toArray();

        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignUserCheck = $repository->find($campaignUserIds[0]);
        $this->assertEquals($campaignUserIds[0], $campaignUserCheck->id);
    }

    public function testCreate()
    {
        $campaignUserData = factory(CampaignUser::class)->make();

        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignUserCheck = $repository->create($campaignUserData->toFillableArray());
        $this->assertNotNull($campaignUserCheck);
    }

    public function testUpdate()
    {
        $campaignUserData = factory(CampaignUser::class)->create();

        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $campaignUserCheck = $repository->update($campaignUserData, $campaignUserData->toFillableArray());
        $this->assertNotNull($campaignUserCheck);
    }

    public function testDelete()
    {
        $campaignUserData = factory(CampaignUser::class)->create();

        /** @var  \App\Repositories\CampaignUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CampaignUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($campaignUserData);

        $campaignUserCheck = $repository->find($campaignUserData->id);
        $this->assertNull($campaignUserCheck);
    }

}
