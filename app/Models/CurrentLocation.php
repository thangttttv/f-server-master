<?php
namespace App\Models;

/**
 * App\Models\CurrentLocation.
 *
 * @method \App\Presenters\CurrentLocationPresenter present()
 *
 * @property int $id
 * @property float $longitude
 * @property float $latitude
 * @property int $user_id
 * @property int $campaign_id
 * @property \Carbon\Carbon $recored_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Campaign $campaign
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereRecordedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CurrentLocation whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string $recorded_at
 */
class CurrentLocation extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'current_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'longitude',
        'latitude',
        'user_id',
        'campaign_id',
        'recorded_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CurrentLocationPresenter::class;

    // Relations
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id', 'id');
    }

    // Utility Functions
}
