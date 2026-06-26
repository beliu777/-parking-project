<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use App\Models\Booking;
use App\Models\Payment;

class ParkingTestDataSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // Пользователи (20)
        // =========================

        for ($i = 1; $i <= 20; $i++) {

            User::create([
                'name' => "Пользователь $i",
                'email' => "park$i@mail.com",
                'password' => bcrypt('12345678'),
            ]);
        }

        // =========================
        // Парковки
        // =========================

        $lots = [
            [
                'name' => 'Парковка Центральная',
                'region' => 'Московская область',
                'address' => 'г. Химки, Центральная 10',
                'description' => 'Главная парковка',
            ],

            [
                'name' => 'Парковка Северная',
                'region' => 'Московская область',
                'address' => 'г. Мытищи, Северная 8',
                'description' => 'Парковка у вокзала',
            ],

            [
                'name' => 'Парковка Южная',
                'region' => 'Московская область',
                'address' => 'г. Подольск, Южная 15',
                'description' => 'Бизнес парковка',
            ],
        ];

        foreach ($lots as $lotData) {

            $lot = ParkingLot::create($lotData);

            // =========================
            // Места (12 на парковку)
            // =========================

            for ($i = 1; $i <= 12; $i++) {

                ParkingSpot::create([
                    'parking_lot_id' => $lot->id,
                    'name' => 'P-' . $i,
                    'zone' => 'Зона ' . ceil($i / 4),
                    'price_per_hour' => rand(100, 300),
                    'is_available' => true,
                    'status' => 'free',
                ]);
            }
        }

        // =========================
        // Бронирования (20)
        // =========================

        for ($i = 1; $i <= 20; $i++) {

            $spot = ParkingSpot::inRandomOrder()->first();

            $booking = Booking::create([
                'user_id' => rand(1, 20),
                'parking_spot_id' => $spot->id,
                'name' => "Пользователь $i",
                'phone' => '+799900000' . rand(10,99),
                'car_number' => 'A' . rand(100,999) . 'BC77',
                'duration_minutes' => [15,30,45,60][array_rand([15,30,45,60])],
                'start_time' => now(),
                'end_time' => now()->addMinutes(60),
                'total_price' => rand(100, 500),
                'qr_code' => 'QR-' . strtoupper(\Illuminate\Support\Str::random(12)),
                'status' => 'paid',
            ]);

            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'method' => 'fake_card',
                'status' => 'paid',
            ]);
        }
    }
}