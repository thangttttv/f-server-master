<?php
namespace App\Http\Responses\API\V1;

class Car extends Response
{
    protected $columns = [
        'id'                    => 0,
        'name'                  => '',
        'carModel'              => '',
        'licensePlateNumber'    => '',
        'yearOfManufacture'     => 0,
        'user'                  => null,
        'image'                 => null,
    ];

    /**
     * @param \App\Models\Car $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                    => $model->id,
                'name'                  => $model->name,
                'carModel'              => $model->car_model,
                'licensePlateNumber'    => $model->license_plate_number,
                'yearOfManufacture'     => $model->year_of_manufacture,
                'image'                 => $model->present()->getCarImageUrl(),
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
