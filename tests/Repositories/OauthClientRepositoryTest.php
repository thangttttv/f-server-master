<?php namespace Tests\Repositories;

use App\Models\OauthClient;
use Tests\TestCase;

class OauthClientRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $oauthClients = factory(OauthClient::class, 3)->create();
        $oauthClientIds = $oauthClients->pluck('id')->toArray();

        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $oauthClientsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(OauthClient::class, $oauthClientsCheck[0]);

        $oauthClientsCheck = $repository->getByIds($oauthClientIds);
        $this->assertEquals(3, count($oauthClientsCheck));
    }

    public function testFind()
    {
        $oauthClients = factory(OauthClient::class, 3)->create();
        $oauthClientIds = $oauthClients->pluck('id')->toArray();

        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $oauthClientCheck = $repository->find($oauthClientIds[0]);
        $this->assertEquals($oauthClientIds[0], $oauthClientCheck->id);
    }

    public function testCreate()
    {
        $oauthClientData = factory(OauthClient::class)->make();

        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $oauthClientCheck = $repository->create($oauthClientData->toFillableArray());
        $this->assertNotNull($oauthClientCheck);
    }

    public function testUpdate()
    {
        $oauthClientData = factory(OauthClient::class)->create();

        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $oauthClientCheck = $repository->update($oauthClientData, $oauthClientData->toFillableArray());
        $this->assertNotNull($oauthClientCheck);
    }

    public function testDelete()
    {
        $oauthClientData = factory(OauthClient::class)->create();

        /** @var  \App\Repositories\OauthClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\OauthClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($oauthClientData);

        $oauthClientCheck = $repository->find($oauthClientData->id);
        $this->assertNull($oauthClientCheck);
    }

}
