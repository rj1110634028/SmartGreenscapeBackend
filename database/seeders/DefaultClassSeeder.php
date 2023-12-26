<?php

namespace Database\Seeders;

use App\Models\DefaultClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefaultClass::create([
            "name" => "龍舌蘭",
            "min_temperature" => "20",
            "min_humidity" => "30",
            "min_soil_humidity" => "30",
            "max_temperature" => "30",
            "max_humidity" => "60",
            "max_soil_humidity" => "60",
        ]);
    }
}
