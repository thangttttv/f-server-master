<?php namespace Tests\Models;

use App\Models\Car;
use Tests\TestCase;

class CarTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Car $car */
        $car = new Car();
        $this->assertNotNull($car);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Car $car */
        $carModel = new Car();

        $carData = factory(Car::class)->make();
        foreach( $carData->toFillableArray() as $key => $value ) {
            $carModel->$key = $value;
        }
        $carModel->save();

        $this->assertNotNull(Car::find($carModel->id));
    }

}
