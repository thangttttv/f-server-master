<?php
namespace App\Models;

/**
 * App\Models\PaymentLog.
 *
 * @method \App\Presenters\PaymentLogPresenter present()
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_account_id
 * @property string $status
 * @property int $paid_amount
 * @property string $paid_for_month
 * @property string $currency_code
 * @property \Carbon\Carbon $paid_at
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\BankAccount $bankAccount
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereBankAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog wherePaidAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog wherePaidForMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog wherePaidAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereCurrencyCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentLog extends Base
{
    const TYPE_STATUS_PAID = 'paid';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bank_account_id',
        'status',
        'paid_amount',
        'paid_for_month',
        'currency_code',
        'paid_at',
        'note',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\PaymentLogPresenter::class;

    // Mutators
    public function setCurrencyCodeAttribute($value)
    {
        $this->attributes['currency_code'] = strtolower($value);
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(\App\Models\BankAccount::class, 'bank_account_id', 'id');
    }

    // Utility Functions
}
