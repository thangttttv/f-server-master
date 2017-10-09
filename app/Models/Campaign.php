<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Campaign.
 *
 * @method \App\Presenters\CampaignPresenter present()
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $distance
 * @property float $minimum_revenue
 * @property float $maximum_revenue
 * @property string $budget_currency_code
 * @property float $budget
 * @property float $spend
 * @property float $total_impression
 * @property string $start_date
 * @property string $end_date
 * @property string $country_code
 * @property int $city_id
 * @property int $advertiser_id
 * @property int $brand_image_id
 * @property string $status
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Advertiser $advertiser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Area[] $areas
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image $brandImage
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereAdvertiserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereBudget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereBudgetCurrencyCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereDistance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereMaximumRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereMinimumRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereSpend($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereTotalImpression($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereBrandImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Campaign whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Campaign extends Base
{
    const STATUS_PENDING = 'pending';
    const STATUS_ONGOING = 'ongoing';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FINISHED = 'finished';

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaigns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'distance',
        'minimum_revenue',
        'maximum_revenue',
        'budget_currency_code',
        'budget',
        'spend',
        'total_impression',
        'start_date',
        'end_date',
        'country_code',
        'city_id',
        'advertiser_id',
        'brand_image_id',
        'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['deleted_at', 'start_date', 'end_date'];

    protected $presenter = \App\Presenters\CampaignPresenter::class;

    // Mutators
    public function setCountryCodeAttribute($value)
    {
        $this->attributes['country_code'] = strtolower($value);
    }

    public function setBudgetCurrencyCodeAttribute($value)
    {
        $this->attributes['budget_currency_code'] = strtolower($value);
    }

    // Relations

    public function images()
    {
        return $this->belongsToMany(\App\Models\Image::class, \App\Models\CampaignImage::getTableName(), 'campaign_id', 'image_id');
    }

    public function wrappingImages()
    {
        return $this->hasMany(\App\Models\CampaignImage::class);
    }

    public function brandImage()
    {
        return $this->belongsTo(\App\Models\Image::class, 'brand_image_id', 'id');
    }

    public function areas()
    {
        return $this->belongsToMany(\App\Models\Area::class, \App\Models\CampaignArea::getTableName(), 'campaign_id', 'area_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_code', 'code');
    }

    public function advertiser()
    {
        return $this->belongsTo(\App\Models\Advertiser::class, 'advertiser_id', 'id');
    }

    // Utility Functions
}
