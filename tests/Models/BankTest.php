<?php namespace Tests\Models;

use App\Models\Bank;
use Tests\TestCase;

class BankTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Bank $bank */
        $bank = new Bank();
        $this->assertNotNull($bank);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Bank $bank */
        $bankModel = new Bank();

        $bankData = factory(Bank::class)->make();
        foreach( $bankData->toFillableArray() as $key => $value ) {
            $bankModel->$key = $value;
        }
        $bankModel->save();

        $this->assertNotNull(Bank::find($bankModel->id));
    }

}
