<?php
namespace App\Models;

/**
 * App\Models\Bank.
 *
 * @method \App\Presenters\BankPresenter present()
 *
 * @property int $id
 * @property string $name
 * @property string $order
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bank extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'order',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\BankPresenter::class;

    // Relations

    // Utility Functions
}
