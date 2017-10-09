<?php
namespace App\Http\Responses\API\V1;

class Countries extends ListBase
{
    protected static $itemsResponseModel = Country::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'countries';
}
