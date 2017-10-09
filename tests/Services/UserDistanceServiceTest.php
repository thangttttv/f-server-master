<?php namespace Tests\Services;

use Tests\TestCase;

class UserDistanceServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\UserDistanceServiceInterface $service */
        $service = \App::make(\App\Services\UserDistanceServiceInterface::class);
        $this->assertNotNull($service);
    }

}
