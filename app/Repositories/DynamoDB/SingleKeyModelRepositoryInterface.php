<?php
namespace App\Repositories\DynamoDB;

interface SingleKeyModelRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param array $input
     *
     * @return \App\Models\DynamoDB\Base
     */
    public function create($input);

    /**
     * @param array $array
     *
     * @return \App\Models\DynamoDB\Base
     */
    public function find($array);
}
