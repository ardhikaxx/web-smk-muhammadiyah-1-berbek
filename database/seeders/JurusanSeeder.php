<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'nama_jurusan' => 'Akuntansi dan Keuangan Lembaga',
                'deskripsi_jurusan' => 'Program studi yang mempersiapkan siswa untuk karir di bidang akuntansi, keuangan, dan administrasi perkantoran.',
                'kode_jurusan' => 'AKL',
                'status' => true,
                'urutan' => 1,
            ],
            [
                'nama_jurusan' => 'Teknik Kendaraan Ringan Otomotif',
                'deskripsi_jurusan' => 'Program studi yang fokus pada perawatan, perbaikan, dan pemeliharaan kendaraan ringan serta sistem otomotif modern.',
                'kode_jurusan' => 'TKRO',
                'status' => true,
                'urutan' => 2,
            ],
            [
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
                'deskripsi_jurusan' => 'Program studi yang mempelajari tentang perakitan komputer, jaringan komputer, dan pengelolaan sistem informasi.',
                'kode_jurusan' => 'TKJ',
                'status' => true,
                'urutan' => 3,
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }

        $this->command->info('Data jurusan berhasil ditambahkan!');
    }
}