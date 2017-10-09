<?php
namespace App\Repositories\Eloquent;

use App\Models\CampaignImage;
use App\Repositories\CampaignImageRepositoryInterface;

/**
 * @method \App\Models\CampaignImage[] getEmptyList()
 * @method \App\Models\CampaignImage[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CampaignImage[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CampaignImage create($value)
 * @method \App\Models\CampaignImage find($id)
 * @method \App\Models\CampaignImage[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CampaignImage[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CampaignImage update($model, $input)
 * @method \App\Models\CampaignImage save($model);
 */
class CampaignImageRepository extends RelationModelRepository implements CampaignImageRepositoryInterface
{
    public function getBlankModel()
    {
        return new CampaignImage();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
