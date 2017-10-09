<?php
namespace App\Http\Responses\API\V1;

class MessageImage extends Response
{
    protected $columns = [
        'id'         => 0,
        'url'        => '',
        'entityType' => '',
        'entityId'   => 0,
        'mediaType'  => '',
        'format'     => '',
        'fileSize'   => 0,
        'width'      => 0,
        'height'     => 0,
    ];

    /**
     * @param \App\Models\Image $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'          => $model->id,
                'url'         => $model->url,
                'entityType'  => $model->entity_type,
                'entityId'    => $model->entity_id,
                'mediaType'   => $model->media_type,
                'format'      => $model->format,
                'fileSize'    => $model->file_size,
                'width'       => $model->width,
                'height'      => $model->height,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
