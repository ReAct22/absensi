<?php

namespace Database\Seeders;

use App\Models\OfficeIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficeIp::create([
            'name' => 'Kantor Utama',
            'ip_address' => '192.168.14.10'
        ]);

        OfficeIp::create([
            'name' => 'Router Kantor',
            'ip_address' => '36.72.150.122' // IP publik kantor
        ]);
    }
}
