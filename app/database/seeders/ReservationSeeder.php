<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'car_id' => null,
                'user_id' => 1,
                'category_id' => 2,
                'start_reservation_date' => '2023-12-26 12:00:00',
                'end_reservation_date' => '2023-12-27 12:00:00',
                'confirm_reservation' => false,
                'confirm_rental' => false,
                'confirm_return' => false
            ],
            [
                'car_id' => null,
                'user_id' => 1,
                'category_id' => 1,
                'start_reservation_date' => '2023-12-26 12:00:00',
                'end_reservation_date' => '2023-12-27 12:00:00',
                'confirm_reservation' => false,
                'confirm_rental' => false,
                'confirm_return' => false
            ],
            [
                'car_id' => null,
                'user_id' => 1,
                'category_id' => 2,
                'start_reservation_date' => '2023-12-26 12:00:00',
                'end_reservation_date' => '2023-12-27 12:00:00',
                'confirm_reservation' => false,
                'confirm_rental' => true,
                'confirm_return' => false
            ],
        ];

        Reservation::insert($reservations);
    }
}
