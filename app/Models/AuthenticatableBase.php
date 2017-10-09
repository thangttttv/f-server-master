<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * App\Models\AuthenticatableBase.
 *
 * @property-read \App\Models\Image $profileImage
 * @property-write mixed $password
 * @mixin \Eloquent
 */
class AuthenticatableBase extends LocaleStorableBase implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public function setPasswordAttribute($password)
    {
        if (empty($password)) {
            $this->attributes['password'] = '';
        } else {
            $this->attributes['password'] = \Hash::make($password);
        }
    }

    // Relation

    public function profileImage()
    {
        return $this->belongsTo('App\Models\Image', 'profile_image_id', 'id');
    }

    public function getProfileImageUrl($width = 0, $height = 0)
    {
        if ($this->profile_image_id == 0) {
            return \URLHelper::asset('img/user.png', 'common');
        }
        if ($width == 0 && $height == 0) {
            return $this->profileImage->url;
        } else {
            return $this->profileImage->url;
        }
    }
}
