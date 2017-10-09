<?php
namespace App\Models;

/**
 * App\Models\TrackingLog.
 *
 * @method \App\Presenters\TrackingLogPresenter present()
 *
 * @property int $id
 * @property int $user_id
 * @property \Carbon\Carbon $date
 * @property int $campaign_id
 * @property string $distance
 * @property string $revenue
 * @property string $revenueCurrencyCode
 * @property string $trajectory
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Campaign $campaign
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereDistance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereRevenueCurrencyCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereTrajectory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackingLog whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string $revenue_currency_code
 */
class TrackingLog extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tracking_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
        'campaign_id',
        'distance',
        'revenue',
        'revenue_currency_code',
        'trajectory',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\TrackingLogPresenter::class;

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
