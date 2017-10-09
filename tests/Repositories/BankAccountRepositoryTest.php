<?php namespace Tests\Repositories;

use App\Models\BankAccount;
use Tests\TestCase;

class BankAccountRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $bankAccounts = factory(BankAccount::class, 3)->create();
        $bankAccountIds = $bankAccounts->pluck('id')->toArray();

        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankAccountsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(BankAccount::class, $bankAccountsCheck[0]);

        $bankAccountsCheck = $repository->getByIds($bankAccountIds);
        $this->assertEquals(3, count($bankAccountsCheck));
    }

    public function testFind()
    {
        $bankAccounts = factory(BankAccount::class, 3)->create();
        $bankAccountIds = $bankAccounts->pluck('id')->toArray();

        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankAccountCheck = $repository->find($bankAccountIds[0]);
        $this->assertEquals($bankAccountIds[0], $bankAccountCheck->id);
    }

    public function testCreate()
    {
        $bankAccountData = factory(BankAccount::class)->make();

        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankAccountCheck = $repository->create($bankAccountData->toFillableArray());
        $this->assertNotNull($bankAccountCheck);
    }

    public function testUpdate()
    {
        $bankAccountData = factory(BankAccount::class)->create();

        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $bankAccountCheck = $repository->update($bankAccountData, $bankAccountData->toFillableArray());
        $this->assertNotNull($bankAccountCheck);
    }

    public function testDelete()
    {
        $bankAccountData = factory(BankAccount::class)->create();

        /** @var  \App\Repositories\BankAccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\BankAccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($bankAccountData);

        $bankAccountCheck = $repository->find($bankAccountData->id);
        $this->assertNull($bankAccountCheck);
    }

}
