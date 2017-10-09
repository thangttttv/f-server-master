<?php
namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;

class FileRepository extends SingleKeyModelRepository implements FileRepositoryInterface
{
    public function getBlankModel()
    {
        return new File();
    }

    public function getByFileCategoryType($fileCategoryType, $order, $direction, $offset, $limit)
    {
        $query = File::whereFileCategoryType($fileCategoryType)->whereIsEnabled(true);

        return $this->getWithQueryBuilder($query, ['id'], 'id', $order, $direction, $offset, $limit);
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
