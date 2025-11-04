<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'HR Admin',
                'email' => 'hr@email.com',
                'password' => Hash::make('hradmin123'),
                'role' => 'HR'
            ],
            [
                'name' => 'Manager Utama',
                'email' => 'manager@email.com',
                'password' => Hash::make('password123'),
                'role' => 'Manager'
            ],
            [
                'name' => 'Pegawai Biasa',
                'email' => 'pegawai@email.com',
                'password' => Hash::make('password123'),
                'role' => 'Pegawai'
            ]
        ];

        foreach($users as $data){
            User::create($data);
        }
    }
}
