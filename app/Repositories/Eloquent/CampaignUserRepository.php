<?php
namespace App\Repositories\Eloquent;

use App\Models\CampaignUser;
use App\Repositories\CampaignUserRepositoryInterface;

/**
 * @method \App\Models\CampaignUser[] getEmptyList()
 * @method \App\Models\CampaignUser[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CampaignUser[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CampaignUser create($value)
 * @method \App\Models\CampaignUser find($id)
 * @method \App\Models\CampaignUser[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CampaignUser[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CampaignUser update($model, $input)
 * @method \App\Models\CampaignUser save($model);
 */
class CampaignUserRepository extends RelationModelRepository implements CampaignUserRepositoryInterface
{
    public function getBlankModel()
    {
        return new CampaignUser();
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

    public function getEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $order, $direction, $offset, $limit)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

    public function countEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $query);

        return $query->count();
    }

    public function AllEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $query);

        return $query->get();
    }

    public function findRunningCampaign($userId, $statusIncluded, $statusExcluded)
    {
        $query      = $this->getBlankModel();
        $campaignId = null;
        $query      = $this->setSearchQuery($userId, $campaignId, $status = '', $statusIncluded, $statusExcluded, $query);

        return $query->first();
    }

    /**
     * @param int   $userId
     * @param int   $campaignId
     * @param array $statusIncluded
     * @param array $statusExcluded
     * @param       $query
     *
     * @return mixed
     */
    private function setSearchQuery($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $query)
    {
        if (!empty($userId)) {
            $query = $query->where(function ($subquery) use ($userId) {
                $subquery->where('user_id', $userId);
            });
        }
        if (!empty($campaignId)) {
            $query = $query->where(function ($subquery) use ($campaignId) {
                $subquery->where('campaign_id', $campaignId);
            });
        }
        if (!empty($name)) {
            $query = $query->where(function ($subquery) use ($name) {
                $subquery->where('name', 'like', '%'.$name.'%');
            });
        }
        if (count($statusExcluded) > 0) {
            $query = $query->where(function ($subquery) use ($statusExcluded) {
                foreach ($statusExcluded as $status) {
                    $subquery->orwhere('status', '<>', $status);
                }
            });
        }
        if (!empty($statusIncluded)) {
            $query = $query->where(function ($subquery) use ($statusIncluded) {
                foreach ($statusIncluded as $status) {
                    $subquery->orwhere('status', $status);
                }
            });
        }

        if (!empty($status)) {
            $query = $query->where(function ($subquery) use ($status) {
                $subquery->orwhere('status', $status);
            });
        }

        return $query;
    }
}
