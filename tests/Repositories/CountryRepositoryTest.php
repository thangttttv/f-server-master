<?php namespace Tests\Repositories;

use App\Models\Country;
use Tests\TestCase;

class CountryRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $countries = factory(Country::class, 3)->create();
        $countryIds = $countries->pluck('id')->toArray();

        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $countriesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Country::class, $countriesCheck[0]);

        $countriesCheck = $repository->getByIds($countryIds);
        $this->assertEquals(3, count($countriesCheck));
    }

    public function testFind()
    {
        $countries = factory(Country::class, 3)->create();
        $countryIds = $countries->pluck('id')->toArray();

        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $countryCheck = $repository->find($countryIds[0]);
        $this->assertEquals($countryIds[0], $countryCheck->id);
    }

    public function testCreate()
    {
        $countryData = factory(Country::class)->make();

        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $countryCheck = $repository->create($countryData->toFillableArray());
        $this->assertNotNull($countryCheck);
    }

    public function testUpdate()
    {
        $countryData = factory(Country::class)->create();

        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $countryCheck = $repository->update($countryData, $countryData->toFillableArray());
        $this->assertNotNull($countryCheck);
    }

    public function testDelete()
    {
        $countryData = factory(Country::class)->create();

        /** @var  \App\Repositories\CountryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CountryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($countryData);

        $countryCheck = $repository->find($countryData->id);
        $this->assertNull($countryCheck);
    }

}
