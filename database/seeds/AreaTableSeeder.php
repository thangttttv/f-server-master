<?php

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locationData = $this->locationData();
        foreach ($locationData as $key => $location) {
            /** @var \App\Repositories\AreaRepositoryInterface $areaRepository */
            $areaRepository = \App::make('App\Repositories\AreaRepositoryInterface');

            /** @var \App\Models\AdminUser $adminUser */
            $area = $areaRepository->create($location);

        }
    }

    private function locationData()
    {
        return config('area');
    }
}