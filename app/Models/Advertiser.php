<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Advertiser.
 *
 * @method \App\Presenters\AdvertiserPresenter present()
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $locale
 * @property int $profile_image_id
 * @property \Carbon\Carbon $deleted_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Image $profileImage
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereProfileImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertiser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Advertiser extends AuthenticatableBase
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
        'profile_image_id',
        'remember_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden    = [];

    protected $dates     = ['deleted_at'];

    protected $presenter = \App\Presenters\AdvertiserPresenter::class;

    // Relations
    public function profileImage()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'profile_image_id');
    }

    // Utility Functions
}
