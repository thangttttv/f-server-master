<?php namespace Tests\Models;

use App\Models\PaymentLog;
use Tests\TestCase;

class PaymentLogTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\PaymentLog $paymentLog */
        $paymentLog = new PaymentLog();
        $this->assertNotNull($paymentLog);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\PaymentLog $paymentLog */
        $paymentLogModel = new PaymentLog();

        $paymentLogData = factory(PaymentLog::class)->make();
        foreach( $paymentLogData->toFillableArray() as $key => $value ) {
            $paymentLogModel->$key = $value;
        }
        $paymentLogModel->save();

        $this->assertNotNull(PaymentLog::find($paymentLogModel->id));
    }

}
