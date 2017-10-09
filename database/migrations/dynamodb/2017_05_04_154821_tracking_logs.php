<?php
namespace Database\Migration\DynamoDB;

use App\Console\Commands\DynamoDB\DBClient;

class TrackingLogs extends DBClient
{
    public function up()
    {
        $this->dbClient->createTable([
            'TableName' => 'tracking_logs',
            'AttributeDefinitions' => [
                [
                    'AttributeName' => 'id',
                    'AttributeType' => 'S',
                ],
            ],
            'KeySchema' => [
                [
                    'AttributeName' => 'id',
                    'KeyType'       => 'HASH',
                ],
            ],
            'ProvisionedThroughput' => [
                'ReadCapacityUnits'  => 1,
                'WriteCapacityUnits' => 1,
            ]
        ]);
        $this->dbClient->waitUntil('TableExists', [
            'TableName' =>  'tracking_logs',
            '@waiter' => [
                'delay' => 5,
                'maxAttempts' => 20,
            ],
        ]);
    }

    /**
     * if cannot rollback set $canRollback = false
     */
    public function down(&$canRollback)
    {
        $this->dbClient->deleteTable([
            'TableName' =>  'tracking_logs',
        ]);
        $this->dbClient->waitUntil('TableNotExists', [
            'TableName' => 'tracking_logs',
            '@waiter' => [
                'delay' => 5,
                'maxAttempts' => 20,
            ],
        ]);
    }
}