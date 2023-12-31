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
                "temperature" => 23,
                "humidity" => 33,
                "soil_humidity" => 33,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-26 11:34:00"
            ], [
                "temperature" => 25,
                "humidity" => 35,
                "soil_humidity" => 35,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-26 11:40:00"
            ], [
                "temperature" => 23,
                "humidity" => 33,
                "soil_humidity" => 33,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-26 12:34:00"
            ], [
                "temperature" => 21,
                "humidity" => 31,
                "soil_humidity" => 31,
                "mac_address" => "A0:B7:65:DE:0C:08",
                "time" => "2023-12-26 12:34:00"
            ]
        ];
        foreach ($data as $value) {
            Data::create($value);
        }
    }
}
