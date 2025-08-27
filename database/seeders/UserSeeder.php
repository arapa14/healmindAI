<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $adminId = DB::table('users')->insertGetId([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'admin',
        ]);

        DB::table('profiles')->insert([
            'user_id' => $adminId,
            'birthdate' => '1995-01-01',
            'gender' => 'male',
            'bio' => 'Admin utama sistem',
        ]);

        // Professional
        $professionalId = DB::table('users')->insertGetId([
            'name' => 'professional',
            'email' => 'professional@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'professional',
        ]);

        DB::table('profiles')->insert([
            'user_id' => $professionalId,
            'birthdate' => '1980-07-15',
            'gender' => 'male',
            'bio' => 'Psikolog dengan pengalaman lebih dari 15 tahun',
        ]);

        DB::table('professionals')->insert([
            'user_id' => $professionalId,
            'license' => 'SIPP-2024-12345',
            'specialty' => 'Psikologi Klinis',
            'experience' => '15 tahun pengalaman',
        ]);

        // User biasa
        $userId = DB::table('users')->insertGetId([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'user',
        ]);

        DB::table('profiles')->insert([
            'user_id' => $userId,
            'birthdate' => '2000-05-10',
            'gender' => 'female',
            'bio' => 'User percobaan',
        ]);
    }
}
