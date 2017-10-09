<?php
namespace App\Repositories;

/**
 * @method \App\Models\Advertiser[] getEmptyList()
 * @method \App\Models\Advertiser[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Advertiser[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Advertiser create($value)
 * @method \App\Models\Advertiser find($id)
 * @method \App\Models\Advertiser[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Advertiser[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Advertiser update($model, $input)
 * @method \App\Models\Advertiser save($model)
 */
interface AdvertiserRepositoryInterface extends AuthenticatableRepositoryInterface
{
}
