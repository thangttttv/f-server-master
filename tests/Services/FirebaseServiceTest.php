<?php namespace Tests\Services;

use Tests\TestCase;

class FirebaseServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\FirebaseServiceInterface $service */
        $service = \App::make(\App\Services\FirebaseServiceInterface::class);
        $this->assertNotNull($service);
    }

}
