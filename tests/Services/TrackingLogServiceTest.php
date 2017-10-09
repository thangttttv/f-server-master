<?php namespace Tests\Services;

use Tests\TestCase;

class TrackingLogServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\TrackingLogServiceInterface $service */
        $service = \App::make(\App\Services\TrackingLogServiceInterface::class);
        $this->assertNotNull($service);
    }

}
