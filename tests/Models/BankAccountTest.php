<?php namespace Tests\Models;

use App\Models\BankAccount;
use Tests\TestCase;

class BankAccountTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\BankAccount $bankAccount */
        $bankAccount = new BankAccount();
        $this->assertNotNull($bankAccount);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\BankAccount $bankAccount */
        $bankAccountModel = new BankAccount();

        $bankAccountData = factory(BankAccount::class)->make();
        foreach( $bankAccountData->toFillableArray() as $key => $value ) {
            $bankAccountModel->$key = $value;
        }
        $bankAccountModel->save();

        $this->assertNotNull(BankAccount::find($bankAccountModel->id));
    }

}
