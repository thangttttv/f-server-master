<?php
namespace App\Http\Responses\API\V1;

class Country extends Response
{
    protected $columns = [
        'id'        => 0,
        'code'      => '',
        'nameEn'    => '',
        'nameLocal' => '',
        'flagImage' => null,
        'order'     => 0,
    ];

    /**
     * @param \App\Models\Country $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'        => $model->id,
                'code'      => $model->code,
                'nameEn'    => $model->name_en,
                'nameLocal' => $model->name_local,
                'flagImage' => $model->present()->getFlagImageUrl(),
                'order'     => $model->order,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
