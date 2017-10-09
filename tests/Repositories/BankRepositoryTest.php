<?php namespace Tests\Repositories;

use App\Models\Bank;
use Tests\TestCase;

class BankRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $banks = factory(Bank::class, 3)->create();
        $bankIds = $banks->pluck('id')->toArray();

        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);

        $banksCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Bank::class, $banksCheck[0]);

        $banksCheck = $repository->getByIds($bankIds);
        $this->assertEquals(3, count($banksCheck));
    }

    public function testFind()
    {
        $banks = factory(Bank::class, 3)->create();
        $bankIds = $banks->pluck('id')->toArray();

        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankCheck = $repository->find($bankIds[0]);
        $this->assertEquals($bankIds[0], $bankCheck->id);
    }

    public function testCreate()
    {
        $bankData = factory(Bank::class)->make();

        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankCheck = $repository->create($bankData->toFillableArray());
        $this->assertNotNull($bankCheck);
    }

    public function testUpdate()
    {
        $bankData = factory(Bank::class)->create();

        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankCheck = $repository->update($bankData, $bankData->toFillableArray());
        $this->assertNotNull($bankCheck);
    }

    public function testDelete()
    {
        $bankData = factory(Bank::class)->create();

        /** @var  \App\Repositories\BankRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($bankData);

        $bankCheck = $repository->find($bankData->id);
        $this->assertNull($bankCheck);
    }

}
