<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        Admin::create([
            'nama_lengkap' => 'Diva Rahma',
            'email' => 'diva.rahma@smk.com',
            'password' => Hash::make('password'),
            'nomor_telepon' => '081234567891',
            'foto_profil' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Admin::create([
            'nama_lengkap' => 'Admin SMK',
            'email' => 'admin@smk.com',
            'password' => Hash::make('password'),
            'nomor_telepon' => '081234567892',
            'foto_profil' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Akun Admin berhasil ditambahkan');
    }
}