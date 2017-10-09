<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Area.
 *
 * @method \App\Presenters\AreaPresenter present()
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_local
 * @property int $city_id
 * @property string $country_code
 * @property string $location_data
 * @property int $order
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Country $country
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereNameEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereNameLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereLocationData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Area extends Base
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_local',
        'country_code',
        'city_id',
        'order',
        'location_data',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['deleted_at'];

    protected $presenter = \App\Presenters\AreaPresenter::class;

    // Mutators
    public function setCountryCodeAttribute($value)
    {
        $this->attributes['country_code'] = strtolower($value);
    }

    // Relations
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id', 'id');
    }

    // Utility Functions
}
