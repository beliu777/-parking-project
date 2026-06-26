<?php

namespace Database\Seeders;

use App\Models\ParkingSpot;
use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    public function run(): void
    {
        ParkingSpot::truncate();

        $spots = [
            ['name' => 'A1', 'zone' => 'Зона A', 'price_per_hour' => 100, 'is_available' => true],
            ['name' => 'A2', 'zone' => 'Зона A', 'price_per_hour' => 100, 'is_available' => true],
            ['name' => 'A3', 'zone' => 'Зона A', 'price_per_hour' => 120, 'is_available' => true],
            ['name' => 'A4', 'zone' => 'Зона A', 'price_per_hour' => 120, 'is_available' => true],

            ['name' => 'B1', 'zone' => 'Зона B', 'price_per_hour' => 150, 'is_available' => true],
            ['name' => 'B2', 'zone' => 'Зона B', 'price_per_hour' => 150, 'is_available' => true],
            ['name' => 'B3', 'zone' => 'Зона B', 'price_per_hour' => 170, 'is_available' => true],
            ['name' => 'B4', 'zone' => 'Зона B', 'price_per_hour' => 170, 'is_available' => true],

            ['name' => 'C1', 'zone' => 'VIP-зона', 'price_per_hour' => 250, 'is_available' => true],
            ['name' => 'C2', 'zone' => 'VIP-зона', 'price_per_hour' => 250, 'is_available' => true],
            ['name' => 'C3', 'zone' => 'VIP-зона', 'price_per_hour' => 300, 'is_available' => true],
            ['name' => 'C4', 'zone' => 'VIP-зона', 'price_per_hour' => 300, 'is_available' => true],
        ];

        foreach ($spots as $spot) {
            ParkingSpot::create($spot);
        }
    }
}