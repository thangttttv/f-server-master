<?php
namespace App\Http\Responses\API\V1;

use App\Http\Responses\Response as ResponseBase;

class Response extends ResponseBase
{
    protected $columns = [];

    /**
     * @param \App\Models\Base $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([]);

        return $response;
    }
}
