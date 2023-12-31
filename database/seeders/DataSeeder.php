<?php

namespace Database\Seeders;

use App\Models\Data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "temperature" => 23.3342,
                "humidity" => 33.234,
                "soil_humidity" => 33.234,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-30 22:34:00"
            ], [
                "temperature" => 23.3342,
                "humidity" => 33.234,
                "soil_humidity" => 33.234,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-31 11:34:00"
            ], [
                "temperature" => 25.324,
                "humidity" => 35.354,
                "soil_humidity" => 35.74,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-31 11:40:00"
            ], [
                "temperature" => 23.74,
                "humidity" => 33.85,
                "soil_humidity" => 33.462,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-31 12:34:00"
            ], [
                "temperature" => 21.234,
                "humidity" => 31.875,
                "soil_humidity" => 31.453,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-31 12:34:00"
            ]
        ];
        foreach ($data as $value) {
            Data::create($value);
        }
    }
}
