<?php
namespace App\Models;

/**
 * App\Models\CampaignUser.
 *
 * @method \App\Presenters\CampaignUserPresenter present()
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $user_id
 * @property int $wrapping_image_id
 * @property string $status
 * @property \Carbon\Carbon $finished_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\User $user
 * @property-read \App\Models\CampaignImage wrappingImage
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereWrappingImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereFinishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CampaignUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CampaignUser extends Base
{
    const TYPE_STATUS_PENDING   = 'pending';
    const TYPE_STATUS_ONGOING   = 'ongoing';
    const TYPE_STATUS_CANCELED  = 'canceled';
    const TYPE_STATUS_FINISHED  = 'finished';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'wrapping_image_id',
        'status',
        'finished_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['finished_at'];

    protected $presenter = \App\Presenters\CampaignUserPresenter::class;

    // Relations
        public function campaign()
        {
            return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id', 'id');
        }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function wrappingImage()
    {
        return $this->belongsTo(\App\Models\CampaignImage::class, 'wrapping_image_id', 'id');
    }

    // Utility Functions
}
