<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Car.
 *
 * @method \App\Presenters\CarPresenter present()
 *
 * @property int $id
 * @property string $name
 * @property string $car_model
 * @property string $license_plate_number
 * @property int $year_of_manufacture
 * @property int $user_id
 * @property int $image_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Image $profileImage
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereCarModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereLicensePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Car whereYearOfManufacture($value)
 * @mixin \Eloquent
 */
class Car extends Base
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'car_model',
        'license_plate_number',
        'year_of_manufacture',
        'user_id',
        'image_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['deleted_at'];

    protected $presenter = \App\Presenters\CarPresenter::class;

    // Relations
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    public function carImage()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'image_id');
    }

    // Utility Functions
}
