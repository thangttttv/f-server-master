<?php namespace Tests\Services;

use Tests\TestCase;

class MessagingServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\MessagingServiceInterface $service */
        $service = \App::make(\App\Services\MessagingServiceInterface::class);
        $this->assertNotNull($service);
    }

}
