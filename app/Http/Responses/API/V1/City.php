<?php
namespace App\Http\Responses\API\V1;

class City extends Response
{
    protected $columns = [
        'id'                    => 0,
        'nameEn'                => '',
        'nameLocal'             => '',
        'country'               => null,
        'order'                 => 0,
    ];

    /**
     * @param \App\Models\Base $city
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $country   = Country::updateWithModel($model->country)->toArray();
            $countryJs = null;
            if (!empty($country)) {
                $countryJs = $country;
            }
            $modelArray = [
                'id'        => $model->id,
                'nameEn'    => $model->name_en,
                'nameLocal' => $model->name_local,
                'country'   => $countryJs,
                'order'     => $model->order,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
