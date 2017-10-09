<?php namespace Tests\Services;

use Tests\TestCase;

class AdvertiserServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\AdvertiserServiceInterface $service */
        $service = \App::make(\App\Services\AdvertiserServiceInterface::class);
        $this->assertNotNull($service);
    }

}
