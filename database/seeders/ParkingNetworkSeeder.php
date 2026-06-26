<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Support\Facades\DB;

class ParkingNetworkSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parking_spots')->delete();
        DB::table('parking_lots')->delete();

        $lots = [
            [
                'name' => 'Парковка Центральная',
                'region' => 'Московская область',
                'address' => 'г. Химки, ул. Центральная, 10',
                'description' => 'Парковка рядом с торговым центром.',
            ],
            [
                'name' => 'Парковка Северная',
                'region' => 'Московская область',
                'address' => 'г. Мытищи, ул. Северная, 8',
                'description' => 'Удобная парковка рядом с вокзалом.',
            ],
            [
                'name' => 'Парковка Южная',
                'region' => 'Московская область',
                'address' => 'г. Подольск, ул. Южная, 15',
                'description' => 'Парковка возле бизнес-центра.',
            ],
        ];

        foreach ($lots as $lotData) {
            $lot = ParkingLot::create($lotData);

            for ($i = 1; $i <= 12; $i++) {
                ParkingSpot::create([
                    'parking_lot_id' => $lot->id,
                    'name' => 'P-' . $i,
                    'zone' => 'Зона ' . ceil($i / 4),
                    'price_per_hour' => rand(100, 250),
                    'is_available' => true,
                    'status' => 'free',
                ]);
            }
        }
    }
}