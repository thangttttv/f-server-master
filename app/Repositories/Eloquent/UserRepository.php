<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

/**
 * @method \App\Models\User[] getEmptyList()
 * @method \App\Models\User[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\User[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\User create($value)
 * @method \App\Models\User find($id)
 * @method \App\Models\User[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\User[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\User update($model, $input)
 * @method \App\Models\User save($model)
 */
class UserRepository extends AuthenticatableRepository implements UserRepositoryInterface
{
    public function getBlankModel()
    {
        return new User();
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

    public function findByEmailDeleted($email)
    {
        $model = $this->getBlankModel();
        return $query = $model::withTrashed()->where('email', $email)->first();
    }
}
