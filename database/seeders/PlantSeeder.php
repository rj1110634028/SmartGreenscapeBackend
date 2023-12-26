<?php

namespace Database\Seeders;

use App\Models\DefaultClass;
use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plant::create([
            "mac_address" => "A0:B7:65:DE:0C:08",
            ...DefaultClass::first()->toArray(),
        ]);
    }
}
