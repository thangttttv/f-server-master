<?php namespace Tests\Repositories;

use App\Models\City;
use Tests\TestCase;

class CityRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $cities = factory(City::class, 3)->create();
        $cityIds = $cities->pluck('id')->toArray();

        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);

        $citiesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(City::class, $citiesCheck[0]);

        $citiesCheck = $repository->getByIds($cityIds);
        $this->assertEquals(3, count($citiesCheck));
    }

    public function testFind()
    {
        $cities = factory(City::class, 3)->create();
        $cityIds = $cities->pluck('id')->toArray();

        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);

        $cityCheck = $repository->find($cityIds[0]);
        $this->assertEquals($cityIds[0], $cityCheck->id);
    }

    public function testCreate()
    {
        $cityData = factory(City::class)->make();

        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);

        $cityCheck = $repository->create($cityData->toFillableArray());
        $this->assertNotNull($cityCheck);
    }

    public function testUpdate()
    {
        $cityData = factory(City::class)->create();

        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);

        $cityCheck = $repository->update($cityData, $cityData->toFillableArray());
        $this->assertNotNull($cityCheck);
    }

    public function testDelete()
    {
        $cityData = factory(City::class)->create();

        /** @var  \App\Repositories\CityRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CityRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($cityData);

        $cityCheck = $repository->find($cityData->id);
        $this->assertNull($cityCheck);
    }

}
