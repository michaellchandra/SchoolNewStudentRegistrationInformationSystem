<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@mc.com',
            'password' => Hash::make('11223344'),
            'asalSekolah' => 'Sekolah Admin',
            'asalReferensiSekolah' => 'EXPO',
            'role' => 'admin',
        ]);

        // // Menambahkan user biasa
        // User::create([
        //     'email' => 'user@mc.com',
        //     'password' => Hash::make('11223344'),
        //     'asalSekolah' => 'Sekolah User',
        //     'asalReferensiSekolah' => 'EXPO',
        //     'role' => 'user',
        // ]);
    }
}
