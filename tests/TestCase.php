<?php

namespace Tests;

abstract class TestCase extends \Laravel\BrowserKitTesting\TestCase
{
    /** @var bool */
    protected $useDatabase = false;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /** @var \Faker\Generator */
    protected $faker;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $this->faker = \Faker\Factory::create();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        if ($this->useDatabase) {
            $databaseName = \DB::connection()->getDatabaseName();
            $tables = \DB::select('SHOW TABLES');
            $keyName = 'Tables_in_'.$databaseName;
            foreach ($tables as $table) {
                if (property_exists($table, $keyName)) {
                    \DB::table($table->$keyName)->truncate();
                }
            }
            \DB::disableQueryLog();
            $this->artisan('db:seed');
        }
    }

    public function tearDown()
    {
        if ($this->useDatabase) {
            \DB::disconnect();
        }
        parent::tearDown();
    }

}
