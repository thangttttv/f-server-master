<?php
namespace App\Models;

/**
 * App\Models\Country.
 *
 * @method \App\Presenters\CountryPresenter present()
 *
 * @property int $id
 * @property string $code
 * @property string $name_en
 * @property string $name_local
 * @property string $flag_image_id
 * @property int $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Image $flagImage
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereNameEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereNameLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereFlagImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name_en',
        'name_local',
        'flag_image_id',
        'order',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CountryPresenter::class;

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtolower($value);
    }

    // Relations
    public function flagImage()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'flag_image_id');
    }

    // Utility Functions
}
