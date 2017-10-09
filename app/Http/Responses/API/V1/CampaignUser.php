<?php
/**
 * Created by PhpStorm.
 * User: ironh
 * Date: 4/26/2017
 * Time: 4:06 PM.
 */
namespace App\Http\Responses\API\V1;

class CampaignUser extends Response
{
    protected $columns = [
        'id'                => 0,
        'status'            => '',
        'finishedAt'        => '',
        'campaign'          => null,
        'user'              => null,

    ];

    /**
     * @param \App\Models\Base $campaign
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'         => $model->id,
                'status'     => $model->status,
                'finishedAt' => $model->finished_at,
                'campaign'   => (Campaign::updateWithModel($model->campaign))->toArray(),
                'user'       => (User::updateWithModel($model->user))->toArray(),

            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
