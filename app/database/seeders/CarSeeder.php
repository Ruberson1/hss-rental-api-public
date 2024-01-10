<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'brand' => 'Fiat',
                'model' => 'Toro',
                'plate' => 'HVV-5579',
                'year' => 2023,
                'reserved' => true,
                'category_id' => 3
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'plate' => 'HJJ-3579',
                'year' => 2023,
                'reserved' => false,
                'category_id' => 2
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'HB20',
                'plate' => 'HGI-5999',
                'year' => 2023,
                'reserved'=> false,
                'category_id' => 1
            ],
            [
                'brand' => 'Fiat',
                'model' => 'Toro',
                'plate' => 'HVV-4579',
                'year' => 2023,
                'reserved' => true,
                'category_id' => 3
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'plate' => 'HJJ-3699',
                'year' => 2023,
                'reserved' => false,
                'category_id' => 2
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'HB20',
                'plate' => 'HGI-5629',
                'year' => 2023,
                'reserved'=> false,
                'category_id' => 1
            ],
            [
                'brand' => 'Fiat',
                'model' => 'Toro',
                'plate' => 'HVI-5679',
                'year' => 2023,
                'reserved' => true,
                'category_id' => 3
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'plate' => 'HJJ-3599',
                'year' => 2023,
                'reserved' => false,
                'category_id' => 2
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'HB20',
                'plate' => 'HGI-5929',
                'year' => 2023,
                'reserved'=> false,
                'category_id' => 1
            ],

        ];

        Car::insert($cars);
    }
}
