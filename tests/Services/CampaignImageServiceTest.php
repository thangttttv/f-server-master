<?php namespace Tests\Services;

use Tests\TestCase;

class CampaignImageServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\CampaignImageServiceInterface $service */
        $service = \App::make(\App\Services\CampaignImageServiceInterface::class);
        $this->assertNotNull($service);
    }

}
