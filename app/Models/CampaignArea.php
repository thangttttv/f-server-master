<?php
namespace App\Models;

/**
 * App\Models\CampaignArea.
 *
 * @method \App\Presenters\CampaignAreaPresenter present()
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $area_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Area $area
 * @property-read \App\Models\Campaign $campaign
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignArea whereAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignArea whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignArea whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignArea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CampaignArea extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'area_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CampaignAreaPresenter::class;

    // Relations
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
