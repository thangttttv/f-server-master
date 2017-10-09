<?php

namespace Tests\Listeners;

class DatabaseSetupListener extends \PHPUnit_Framework_BaseTestListener
{
    protected $suites = ['Application Test Suite'];

    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
        if (in_array($suite->getName(), $this->suites)) {
            print "START".PHP_EOL;
            exec('php artisan migrate --database testing');
        }
    }

    public function endTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
        if (in_array($suite->getName(), $this->suites)) {
            exec('php artisan migrate:rollback --database testing');
            print "END".PHP_EOL;
        }
    }
}
