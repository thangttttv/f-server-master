<?php
namespace App\Models\DynamoDB;

use BaoPham\DynamoDb\DynamoDbModel;

class TrackingLog extends DynamoDbModel
{
    public $table    = 'tracking_logs';
    public $fillable = [
        'id',
        'tracking_main_id',
        'campaign_id',
        'user_id',
        'date',
        'distance',
        'revenue',
        'revenue_currency_code',
        'trajectory',
        'trajectory_hash',
    ];
}
