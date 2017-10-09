<?php
namespace App\Models;

class AdvertiserNotification extends Notification
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertiser_notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advertiser_id',
        'category_type',
        'type',
        'data',
        'content',
        'locale',
        'read',
        'sent_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['sent_at'];

    protected $presenter = \App\Presenters\AdvertiserNotificationPresenter::class;

    // Relations
        public function advertiser()
        {
            return $this->belongsTo(\App\Models\Advertiser::class, 'advertiser_id', 'id');
        }

    // Utility Functions
}
