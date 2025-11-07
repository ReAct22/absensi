<?php

namespace Database\Seeders;

use App\Models\GeoFence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeoFenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeoFence::create([
            'name' => 'Kantor Pusat',
            'latitude' => -6.175392,
            'longtitude' => 106.827153,
            'radius' => 100
        ]);
    }
}
