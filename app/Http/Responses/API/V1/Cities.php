<?php
namespace App\Http\Responses\API\V1;

class Cities extends ListBase
{
    protected static $itemsResponseModel = City::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'cities';
}
