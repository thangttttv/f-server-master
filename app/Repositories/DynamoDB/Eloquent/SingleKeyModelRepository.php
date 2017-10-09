<?php
namespace App\Repositories\DynamoDB\Eloquent;

use App\Repositories\DynamoDB\SingleKeyModelRepositoryInterface;

class SingleKeyModelRepository extends BaseRepository implements SingleKeyModelRepositoryInterface
{
    public function create($input)
    {
        $model = $this->getBlankModel();
        $model->fill($input)->save();

        return $model;
    }

    public function find($array)
    {
        //        print_r($array);exit();
        $model = $this->getBlankModel();
//        echo $model->getTableName();
//        print_r($model);
//        exit();
        return $model->find($array);
    }
}
