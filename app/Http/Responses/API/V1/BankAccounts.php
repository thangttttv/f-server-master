<?php
namespace App\Http\Responses\API\V1;

class BankAccounts extends ListBase
{
    protected static $itemsResponseModel = BankAccount::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'bank_accounts';

    protected $columns = [
        'items' => [],
    ];

    public static function updateListAllWithModel($models)
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = (static::$itemsResponseModel)::updateWithModel($model)->toArray();
        }
        $response = new static([
            'items' => $items,
        ], 200);

        return $response;
    }
}
