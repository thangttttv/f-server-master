<?php
namespace App\Http\Responses\API\V1;

class Advertiser extends Response
{
    protected $columns = [
        'id'                    => 0,
        'name'                  => '',
        'profileImage'          => null,
    ];

    protected $optionalColumns = [
    ];

    /**
     * @param \App\Models\Advertiser $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $response = new static([
                'id'           => $model->id,
                'name'         => $model->name,
                'profileImage' => $model->present()->getProfileImageUrl(),
            ], 200);
        }

        return $response;
    }
}
