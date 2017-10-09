<?php
namespace App\Repositories\Eloquent;

use App\Models\CampaignImpression;
use App\Repositories\CampaignImpressionRepositoryInterface;

/**
 * @method \App\Models\CampaignImpression[] getEmptyList()
 * @method \App\Models\CampaignImpression[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CampaignImpression[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CampaignImpression create($value)
 * @method \App\Models\CampaignImpression find($id)
 * @method \App\Models\CampaignImpression[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CampaignImpression[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CampaignImpression update($model, $input)
 * @method \App\Models\CampaignImpression save($model);
 */
class CampaignImpressionRepository extends SingleKeyModelRepository implements CampaignImpressionRepositoryInterface
{
    public function getBlankModel()
    {
        return new CampaignImpression();
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
