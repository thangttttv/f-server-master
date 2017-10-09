<?php
namespace App\Http\Responses\API\V1;

class Bank extends Response
{
    protected $columns = [
        'id'          => 0,
        'name'        => '',
        'description' => '',
        'order'       => 0,
    ];

    /**
     * @param \App\Models\Bank $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'          => $model->id,
                'name'        => $model->name,
                'description' => $model->description,
                'order'       => $model->order,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
