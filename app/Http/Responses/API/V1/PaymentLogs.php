<?php
namespace App\Http\Responses\API\V1;

class PaymentLogs extends ListBase
{
    protected static $itemsResponseModel = PaymentLog::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'payment_logs';
}
