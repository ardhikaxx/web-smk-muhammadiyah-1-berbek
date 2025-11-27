<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengajar;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajars = [
            // Pimpinan Sekolah
            [
                'nama_pengajar' => 'Dr. H. Ahmad Fauzi, M.Pd.',
                'nip' => '196512101992031001',
                'jabatan' => 'Kepala Sekolah',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 1,
            ],
            [
                'nama_pengajar' => 'Drs. Bambang Sutrisno, M.M.',
                'nip' => '196808151995121001',
                'jabatan' => 'Wakil Kepala Sekolah Bidang Kurikulum',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 2,
            ],
            [
                'nama_pengajar' => 'Siti Aminah, M.Pd.',
                'nip' => '197203201998022001',
                'jabatan' => 'Wakil Kepala Sekolah Bidang Kesiswaan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 3,
            ],
            [
                'nama_pengajar' => 'Ir. Muhammad Rizki, M.T.',
                'nip' => '197511152001121001',
                'jabatan' => 'Wakil Kepala Sekolah Bidang Sarana Prasarana',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 4,
            ],

            // Staff Tata Usaha
            [
                'nama_pengajar' => 'Dewi Sartika, S.E.',
                'nip' => '198204102005012001',
                'jabatan' => 'Kepala Tata Usaha',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 5,
            ],
            [
                'nama_pengajar' => 'Rina Marlina, S.IP.',
                'nip' => '198512152007022001',
                'jabatan' => 'Staff Administrasi Kurikulum',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 6,
            ],
            [
                'nama_pengajar' => 'Ahmad Syafii, S.Kom.',
                'nip' => '198902102010011001',
                'jabatan' => 'Staff IT dan Data',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 7,
            ],

            // Guru Teknik Komputer dan Jaringan (TKJ)
            [
                'nama_pengajar' => 'Rudi Hartono, S.Kom., M.Kom.',
                'nip' => '197810102003121001',
                'jabatan' => 'Guru Produktif TKJ - Jaringan Komputer',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 8,
            ],
            [
                'nama_pengajar' => 'Linda Sari, S.T., M.T.',
                'nip' => '198103152006042001',
                'jabatan' => 'Guru Produktif TKJ - Sistem Operasi',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 9,
            ],
            [
                'nama_pengajar' => 'Fajar Nugroho, S.Kom.',
                'nip' => '198609202009101001',
                'jabatan' => 'Guru Produktif TKJ - Pemrograman Web',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 10,
            ],
            [
                'nama_pengajar' => 'Maya Sari, S.Kom.',
                'nip' => '198912152012022001',
                'jabatan' => 'Guru Produktif TKJ - Keamanan Jaringan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 11,
            ],

            // Guru Akuntansi dan Keuangan Lembaga (AKL)
            [
                'nama_pengajar' => 'Dra. Sri Wahyuni, M.Ak.',
                'nip' => '197504181998022001',
                'jabatan' => 'Guru Produktif AKL - Akuntansi Perusahaan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 12,
            ],
            [
                'nama_pengajar' => 'Budi Santoso, S.E., M.Ak.',
                'nip' => '197912202003121001',
                'jabatan' => 'Guru Produktif AKL - Perpajakan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 13,
            ],
            [
                'nama_pengajar' => 'Anita Permata, S.E.',
                'nip' => '198206252007022001',
                'jabatan' => 'Guru Produktif AKL - Komputer Akuntansi',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 14,
            ],
            [
                'nama_pengajar' => 'Rizki Amelia, S.E., M.M.',
                'nip' => '198710302010012001',
                'jabatan' => 'Guru Produktif AKL - Manajemen Keuangan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 15,
            ],

            // Guru Teknik Kendaraan Ringan Otomotif (TKRO)
            [
                'nama_pengajar' => 'Ir. Joko Susilo, M.T.',
                'nip' => '197205151997031001',
                'jabatan' => 'Guru Produktif TKRO - Mesin Kendaraan Ringan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 16,
            ],
            [
                'nama_pengajar' => 'Drs. Agus Setiawan',
                'nip' => '197611202000121001',
                'jabatan' => 'Guru Produktif TKRO - Kelistrikan Otomotif',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 17,
            ],
            [
                'nama_pengajar' => 'Ahmad Firdaus, S.T.',
                'nip' => '198302152005011001',
                'jabatan' => 'Guru Produktif TKRO - Sistem Pemindah Tenaga',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 18,
            ],
            [
                'nama_pengajar' => 'Suryadi, S.Pd.',
                'nip' => '198708202008011001',
                'jabatan' => 'Guru Produktif TKRO - Chassis dan Pemeliharaan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 19,
            ],

            // Guru Umum (Normatif & Adaptif)
            [
                'nama_pengajar' => 'Dra. Maria Ulfa',
                'nip' => '197301201996012001',
                'jabatan' => 'Guru Bahasa Indonesia',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 20,
            ],
            [
                'nama_pengajar' => 'S.Pd. John Smith, M.Pd.',
                'nip' => '197409251998031001',
                'jabatan' => 'Guru Bahasa Inggris',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 21,
            ],
            [
                'nama_pengajar' => 'Drs. Hasan Basri',
                'nip' => '197602281999031001',
                'jabatan' => 'Guru Matematika',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 22,
            ],
            [
                'nama_pengajar' => 'Siti Khodijah, S.Pd.',
                'nip' => '198001152003122001',
                'jabatan' => 'Guru Pendidikan Agama Islam',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 23,
            ],
            [
                'nama_pengajar' => 'Andi Prasetyo, S.Pd.',
                'nip' => '198304202006041001',
                'jabatan' => 'Guru Pendidikan Kewarganegaraan',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 24,
            ],
            [
                'nama_pengajar' => 'Fitriani, S.Pd.',
                'nip' => '198605202009022001',
                'jabatan' => 'Guru Seni Budaya',
                'foto_pengajar' => '',
                'status' => true,
                'urutan' => 25,
            ],
        ];

        foreach ($pengajars as $pengajar) {
            Pengajar::create($pengajar);
        }

        $this->command->info('25 data pengajar berhasil ditambahkan!');
    }
}