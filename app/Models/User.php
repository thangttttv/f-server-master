<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User.
 *
 * @method \App\Presenters\UserPresenter present()
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $email
 * @property string $password
 * @property string $date_of_birth
 * @property string $current_latitude
 * @property string $current_longitude
 * @property string $locale
 * @property string $country_code
 * @property int $city_id
 * @property int $main_area_id
 * @property int $profile_image_id
 * @property int $drivers_licence_image_id
 * @property \Carbon\Carbon $deleted_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \App\Models\Country $country
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Image $profileImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereMainAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCurrentLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCurrentLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDriversLicenceImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereProfileImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends AuthenticatableBase
{
    use HasApiTokens, Notifiable, SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $presenter = \App\Presenters\UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'country_code',
        'city_id',
        'main_area_id',
        'current_latitude',
        'current_longitude',
        'email',
        'password',
        'locale',
        'remember_token',
        'profile_image_id',
        'drivers_licence_image_id',
        'date_of_birth',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    // Mutators
    public function setCountryCodeAttribute($value)
    {
        $this->attributes['country_code'] = strtolower($value);
    }

    // Relations
    public function driverLicenceImage()
    {
        return $this->belongsTo(\App\Models\Image::class, 'drivers_licence_image_id', 'id');
    }

    public function profileImage()
    {
        return $this->belongsTo(\App\Models\Image::class, 'profile_image_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id', 'id');
    }

    public function mainArea()
    {
        return $this->belongsTo(\App\Models\Area::class, 'main_area_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'id', 'user_id');
    }

    public function bankAccounts()
    {
        return $this->hasMany(\App\Models\BankAccount::class);
    }
}
