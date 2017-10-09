<?php namespace Tests\Repositories;

use App\Models\PaymentLog;
use Tests\TestCase;

class PaymentLogRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $paymentLogs = factory(PaymentLog::class, 3)->create();
        $paymentLogIds = $paymentLogs->pluck('id')->toArray();

        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $paymentLogsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(PaymentLog::class, $paymentLogsCheck[0]);

        $paymentLogsCheck = $repository->getByIds($paymentLogIds);
        $this->assertEquals(3, count($paymentLogsCheck));
    }

    public function testFind()
    {
        $paymentLogs = factory(PaymentLog::class, 3)->create();
        $paymentLogIds = $paymentLogs->pluck('id')->toArray();

        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $paymentLogCheck = $repository->find($paymentLogIds[0]);
        $this->assertEquals($paymentLogIds[0], $paymentLogCheck->id);
    }

    public function testCreate()
    {
        $paymentLogData = factory(PaymentLog::class)->make();

        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $paymentLogCheck = $repository->create($paymentLogData->toFillableArray());
        $this->assertNotNull($paymentLogCheck);
    }

    public function testUpdate()
    {
        $paymentLogData = factory(PaymentLog::class)->create();

        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $paymentLogCheck = $repository->update($paymentLogData, $paymentLogData->toFillableArray());
        $this->assertNotNull($paymentLogCheck);
    }

    public function testDelete()
    {
        $paymentLogData = factory(PaymentLog::class)->create();

        /** @var  \App\Repositories\PaymentLogRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PaymentLogRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($paymentLogData);

        $paymentLogCheck = $repository->find($paymentLogData->id);
        $this->assertNull($paymentLogCheck);
    }

}
