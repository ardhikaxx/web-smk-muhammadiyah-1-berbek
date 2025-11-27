<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestasi;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestasis = [
            // Prestasi Tahun 2024
            [
                'nama_siswa' => 'Ahmad Rizki Pratama',
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'nama_prestasi' => 'Juara 1 Lomba Coding Competition Nasional',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 15,
            ],
            [
                'nama_siswa' => 'Siti Nurhaliza',
                'jurusan' => 'Multimedia',
                'nama_prestasi' => 'Juara 2 Lomba Desain Grafis Se-Jawa Timur',
                'peringkat' => 'Juara 2',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 14,
            ],
            [
                'nama_siswa' => 'Budi Santoso',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'nama_prestasi' => 'Juara 3 Olimpiade Matematika Tingkat Provinsi',
                'peringkat' => 'Juara 3',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 13,
            ],
            [
                'nama_siswa' => 'Maya Sari Dewi',
                'jurusan' => 'Akuntansi',
                'nama_prestasi' => 'Juara 1 Lomba Akuntansi Sekolah Menengah',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 12,
            ],
            [
                'nama_siswa' => 'Rizki Ramadhan',
                'jurusan' => 'Teknik Kendaraan Ringan',
                'nama_prestasi' => 'Juara 2 Lomba Otomotif Honda Skill Contest',
                'peringkat' => 'Juara 2',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 11,
            ],
            [
                'nama_siswa' => 'Dewi Lestari',
                'jurusan' => 'Tata Boga',
                'nama_prestasi' => 'Juara 1 Lomba Memasak Traditional Food Competition',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 10,
            ],
            [
                'nama_siswa' => 'Fajar Nugroho',
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'nama_prestasi' => 'Juara 3 Kompetisi Jaringan Cisco NetRiders',
                'peringkat' => 'Juara 3',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 9,
            ],
            [
                'nama_siswa' => 'Nadia Putri',
                'jurusan' => 'Multimedia',
                'nama_prestasi' => 'Juara 1 Lomba Fotografi Youth Photo Contest',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2024,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 8,
            ],

            // Prestasi Tahun 2025
            [
                'nama_siswa' => 'Rafi Ahmad Maulana',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'nama_prestasi' => 'Juara 1 Hackathon Digital Innovation Challenge',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 7,
            ],
            [
                'nama_siswa' => 'Cindy Aurelia',
                'jurusan' => 'Akuntansi',
                'nama_prestasi' => 'Juara 2 Lomba Financial Literacy Competition',
                'peringkat' => 'Juara 2',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 6,
            ],
            [
                'nama_siswa' => 'Kevin Pratama',
                'jurusan' => 'Teknik Kendaraan Ringan',
                'nama_prestasi' => 'Juara 1 Kompetisi Engine Tune-up Nasional',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 5,
            ],
            [
                'nama_siswa' => 'Sarah Amanda',
                'jurusan' => 'Tata Boga',
                'nama_prestasi' => 'Juara 3 Lomba Patisserie Junior Championship',
                'peringkat' => 'Juara 3',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 4,
            ],
            [
                'nama_siswa' => 'Dimas Bagus',
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'nama_prestasi' => 'Juara 2 Cyber Security Competition',
                'peringkat' => 'Juara 2',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 3,
            ],
            [
                'nama_siswa' => 'Larasati Wulandari',
                'jurusan' => 'Multimedia',
                'nama_prestasi' => 'Juara 1 Lomba Video Editing Creative Fest',
                'peringkat' => 'Juara 1',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 2,
            ],
            [
                'nama_siswa' => 'Aldi Setiawan',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'nama_prestasi' => 'Juara 3 Mobile App Development Contest',
                'peringkat' => 'Juara 3',
                'tahun_prestasi' => 2025,
                'foto_prestasi' => '',
                'status' => true,
                'urutan' => 1,
            ],
        ];

        foreach ($prestasis as $prestasi) {
            Prestasi::create($prestasi);
        }

        $this->command->info('15 data prestasi berhasil ditambahkan!');
    }
}