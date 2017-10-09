<?php
namespace App\Models;

/**
 * App\Models\CampaignImpression.
 *
 * @method \App\Presenters\CampaignImpressionPresenter present()
 *
 * @property int $id
 * @property int $campaign_id
 * @property float $total_impression
 * @property float $total_cost
 * @property string $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\CampaignUser $campaignArea
 *

 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereTotalImpression($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereTotalCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CampaignImpression extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_impressions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'total_impression',
        'total_cost',
        'date',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CampaignImpressionPresenter::class;

    // Relations
        public function campaign()
        {
            return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id', 'id');
        }

    // Utility Functions
}
