<?php
namespace App\Models;

/**
 * App\Models\AreaWeightLog.
 *
 * @method \App\Presenters\AreaWeightLogPresenter present()
 *
 * @property int $id
 * @property int $area_id
 * @property string $day_of_week
 * @property int $start_time
 * @property int $end_time
 * @property float $weight
 * @property \Carbon\Carbon $active_to
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereDayOfWeek($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereActiveTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeightLog whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Area $area
 */
class AreaWeightLog extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'area_weight_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'day_of_week',
        'start_time',
        'end_time',
        'weight',
        'active_to',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['active_to'];

    protected $presenter = \App\Presenters\AreaWeightLogPresenter::class;

    // Relations
    public function area()
    {
        return $this->belongsTo(\App\Models\Area::class, 'area_id', 'id');
    }

    // Utility Functions
}
