<?php
namespace App\Repositories;

interface PaymentLogRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param string $status
     * @param int    $paidAmount
     * @param int    $userId
     * @param string $paidForMonth
     * @param int    $bankAccountId
     * @param string $order
     * @param string $direction
     * @param int    $offset
     * @param int    $limit
     *
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function getEnabledWithConditions($status, $paidAmount, $userId, $paidForMonth, $bankAccountId, $order, $direction, $offset, $limit);

    /**
     * @param string $status
     * @param int    $paidAmount
     * @param int    $userId
     * @param string $paidForMonth
     * @param int    $bankAccountId
     *
     * @return int
     */
    public function countEnabledWithConditions($status, $paidAmount, $userId, $paidForMonth, $bankAccountId);
}
