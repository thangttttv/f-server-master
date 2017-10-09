<?php
namespace App\Repositories\Eloquent;

use App\Models\PaymentLog;
use App\Repositories\PaymentLogRepositoryInterface;

/**
 * @method \App\Models\PaymentLog[] getEmptyList()
 * @method \App\Models\PaymentLog[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\PaymentLog[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\PaymentLog create($value)
 * @method \App\Models\PaymentLog find($id)
 * @method \App\Models\PaymentLog[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\PaymentLog[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\PaymentLog update($model, $input)
 * @method \App\Models\PaymentLog save($model);
 */
class PaymentLogRepository extends SingleKeyModelRepository implements PaymentLogRepositoryInterface
{
    public function getBlankModel()
    {
        return new PaymentLog();
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

    public function getEnabledWithConditions($status, $paidAmount, $userId, $paidForMonth, $bankAccount, $order, $direction, $offset, $limit)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($status, $paidAmount, $userId, $paidForMonth, $bankAccount, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

    public function countEnabledWithConditions($status, $paidAmount, $userId, $paidForMonth, $bankAccount)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($status, $paidAmount, $userId, $paidForMonth, $bankAccount, $query);

        return $query->count();
    }

    /**
     * @param string                             $status
     * @param int                                $paidAmount
     * @param int                                $bankAccountId
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    private function setSearchQuery($status, $paidAmount, $userId, $paidForMonth, $bankAccountId, $query)
    {
        if (!empty($status)) {
            $query = $query->where(function ($subquery) use ($status) {
                $subquery->where('status', $status);
            });
        }
        if (!empty($paidAmount)) {
            $query = $query->where(function ($subquery) use ($paidAmount) {
                $subquery->where('paid_amount', $paidAmount);
            });
        }
        if (!empty($userId)) {
            $query = $query->where(function ($subquery) use ($userId) {
                $subquery->where('user_id', $userId);
            });
        }

        if (!empty($paidForMonth)) {
            $query = $query->where(function ($subquery) use ($paidForMonth) {
                $subquery->where('paid_for_month', $paidForMonth);
            });
        }

        if (!empty($bankAccountId)) {
            $query = $query->where(function ($subquery) use ($bankAccountId) {
                $subquery->where('bank_account_id', $bankAccountId);
            });
        }

        return $query;
    }
}
