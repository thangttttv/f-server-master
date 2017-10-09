<?php
namespace App\Models;

/**
 * App\Models\BankAccount.
 *
 * @method \App\Presenters\BankAccountPresenter present()
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string $owner_name
 * @property string $branch_name
 * @property string $account_info
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Bank $bank
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereAccountInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereBranchName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereOwnerName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BankAccount whereUserId($value)
 * @mixin \Eloquent
 */
class BankAccount extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bank_id',
        'branch_name',
        'owner_name',
        'account_info',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\BankAccountPresenter::class;

    // Relations
        public function user()
        {
            return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
        }

    public function bank()
    {
        return $this->belongsTo(\App\Models\Bank::class, 'bank_id', 'id');
    }

    // Utility Functions
}
