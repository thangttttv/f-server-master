<?php
namespace App\Models;

/**
 * App\Models\AreaWeight.
 *
 * @method \App\Presenters\AreaWeightPresenter present()
 *
 * @property int $id
 * @property int $area_id
 * @property int $day_of_week
 * @property int $start_time
 * @property int $end_time
 * @property float $weight
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereDayOfWeek($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AreaWeight whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Area $area
 */
class AreaWeight extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'area_weights';

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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\AreaWeightPresenter::class;

    // Relations
        public function area()
        {
            return $this->belongsTo(\App\Models\Area::class, 'area_id', 'id');
        }

    // Utility Functions
}
