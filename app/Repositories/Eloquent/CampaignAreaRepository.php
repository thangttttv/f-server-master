<?php
namespace App\Repositories\Eloquent;

use App\Models\CampaignArea;
use App\Repositories\CampaignAreaRepositoryInterface;

/**
 * @method \App\Models\CampaignArea[] getEmptyList()
 * @method \App\Models\CampaignArea[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CampaignArea[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CampaignArea create($value)
 * @method \App\Models\CampaignArea find($id)
 * @method \App\Models\CampaignArea[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CampaignArea[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CampaignArea update($model, $input)
 * @method \App\Models\CampaignArea save($model);
 */
class CampaignAreaRepository extends RelationModelRepository implements CampaignAreaRepositoryInterface
{
    protected $parentKey = 'campaign_id';

    protected $childKey = 'area_id';

    public function getBlankModel()
    {
        return new CampaignArea();
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
