<?php
namespace App\Models;

/**
 * App\Models\CampaignImage.
 *
 * @method \App\Presenters\CampaignImagePresenter present()
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $image_id
 * @property float $base_revenue
 * @property string $currency_code
 * @property string $image_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\Image $image
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereCurrencyCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereBaseRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereImageType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CampaignImage extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'image_id',
        'base_revenue',
        'currency_code',
        'image_type',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CampaignImagePresenter::class;

    // Relations
    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(\App\Models\Image::class, 'image_id', 'id');
    }

    // Utility Functions
}
