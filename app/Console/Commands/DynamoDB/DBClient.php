<?php
namespace App\Console\Commands\DynamoDB;

use Aws\DynamoDb\DynamoDbClient;

class DBClient
{
    protected $dbClient;

    public function __construct()
    {
        $this->dbClient = static::factory();
    }

    public static function factory()
    {
        return DynamoDbClient::factory([
            'endpoint'    => config('services.dynamodb.local_endpoint'),
            'region'      => config('services.dynamodb.region'),
            'version'     => 'latest',
            'credentials' => [
                'key'    => config('services.dynamodb.key'),
                'secret' => config('services.dynamodb.secret'),
            ],
        ]);
    }
}
