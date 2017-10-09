<?php namespace Tests\Services;

use Tests\TestCase;

class OAuthServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\OAuthServiceInterface $service */
        $service = \App::make(\App\Services\OAuthServiceInterface::class);
        $this->assertNotNull($service);
    }

}
