<?php
namespace App\Http\Responses\API\V1;

class Banks extends ListBase
{
    protected static $itemsResponseModel = Bank::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'banks';
}
