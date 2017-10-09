<?php
namespace App\Repositories\Eloquent;

use App\Models\TrackingLog;
use App\Repositories\TrackingLogRepositoryInterface;

/**
 * @method \App\Models\TrackingLog[] getEmptyList()
 * @method \App\Models\TrackingLog[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\TrackingLog[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\TrackingLog create($value)
 * @method \App\Models\TrackingLog find($id)
 * @method \App\Models\TrackingLog[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\TrackingLog[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\TrackingLog update($model, $input)
 * @method \App\Models\TrackingLog save($model);
 */
class TrackingLogRepository extends SingleKeyModelRepository implements TrackingLogRepositoryInterface
{
    public function getBlankModel()
    {
        return new TrackingLog();
    }

    public function rules()
    {
        return [
            'user_id'               => 'required',
            'date'                  => 'required',
            'campaign_id'           => 'required',
            'distance'              => 'required',
            'revenue'               => 'required',
            'revenue_currency_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'               => 'validation.required',
            'date.required'                  => 'validation.required',
            'campaign_id.required'           => 'validation.required',
            'distance.required'              => 'validation.required',
            'revenue.required'               => 'validation.required',
            'revenue_currency_code.required' => 'validation.required',
        ];
    }
}
