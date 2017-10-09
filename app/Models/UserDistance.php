<?php
namespace App\Models;

/**
 * App\Models\UserDistance.
 *
 * @method \App\Presenters\UserDistancePresenter present()
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $area_id
 * @property int $user_id
 * @property float $distance
 * @property float $total_cost
 * @property float $total_impression
 * @property string $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Area $area
 *

 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereDistance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereTotalCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereTotalImpression($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserDistance extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_distances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'area_id',
        'distance',
        'total_cost',
        'total_impression',
        'date',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\UserDistancePresenter::class;

    // Relations
        public function user()
        {
            return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
        }

    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(\App\Models\Area::class, 'area_id', 'id');
    }

    // Utility Functions
}
