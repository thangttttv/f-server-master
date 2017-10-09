<?php namespace Tests\Repositories;

use App\Models\Car;
use Tests\TestCase;

class CarRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $cars = factory(Car::class, 3)->create();
        $carIds = $cars->pluck('id')->toArray();

        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);

        $carsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Car::class, $carsCheck[0]);

        $carsCheck = $repository->getByIds($carIds);
        $this->assertEquals(3, count($carsCheck));
    }

    public function testFind()
    {
        $cars = factory(Car::class, 3)->create();
        $carIds = $cars->pluck('id')->toArray();

        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);

        $carCheck = $repository->find($carIds[0]);
        $this->assertEquals($carIds[0], $carCheck->id);
    }

    public function testCreate()
    {
        $carData = factory(Car::class)->make();

        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);

        $carCheck = $repository->create($carData->toFillableArray());
        $this->assertNotNull($carCheck);
    }

    public function testUpdate()
    {
        $carData = factory(Car::class)->create();

        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);

        $carCheck = $repository->update($carData, $carData->toFillableArray());
        $this->assertNotNull($carCheck);
    }

    public function testDelete()
    {
        $carData = factory(Car::class)->create();

        /** @var  \App\Repositories\CarRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CarRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($carData);

        $carCheck = $repository->find($carData->id);
        $this->assertNull($carCheck);
    }

}
