<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengumumen = [
            // PPDB 2025/2026
            [
                'nama_pengumuman' => 'PPDB 2025/2026 - Pendaftaran Siswa Baru',
                'deskripsi_pengumuman' => 'Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2025/2026 SMK Muhammadiyah 1 Berbek telah dibuka. Daftarkan segera putra-putri Anda untuk bergabung dengan keluarga besar SMK Muhammadiyah 1 Berbek. Program keahlian yang tersedia: Teknik Komputer dan Jaringan, Akuntansi dan Keuangan Lembaga, Teknik Kendaraan Ringan Otomotif.',
                'foto_pengumuman' => '',
                'status' => true,
                'urutan' => 5,
            ],
            [
                'nama_pengumuman' => 'Jadwal Tes Masuk PPDB 2025/2026',
                'deskripsi_pengumuman' => 'Berikut jadwal tes masuk untuk calon peserta didik baru tahun ajaran 2025/2026:
                
Gelombang 1: 15 Januari 2025
Gelombang 2: 12 Februari 2025  
Gelombang 3: 12 Maret 2025

Tes meliputi:
- Tes Akademik (Matematika, Bahasa Indonesia, Bahasa Inggris)
- Tes Bakat Minat
- Wawancara

Persyaratan:
- Fotokopi ijazah SMP/sederajat
- Fotokopi SKHUN
- Pas foto 3x4 (2 lembar)
- Fotokopi akta kelahiran
- Fotokopi KK',
                'foto_pengumuman' => '',
                'status' => true,
                'urutan' => 4,
            ],
            [
                'nama_pengumuman' => 'Beasiswa Prestasi untuk Siswa Baru 2025/2026',
                'deskripsi_pengumuman' => 'SMK Muhammadiyah 1 Berbek membuka program beasiswa prestasi untuk calon siswa baru tahun ajaran 2025/2026. Beasiswa tersedia untuk siswa berprestasi di bidang akademik dan non-akademik.

Jenis Beasiswa:
1. Beasiswa Prestasi Akademik (Nilai UN ≥ 85)
2. Beasiswa Olahraga dan Seni
3. Beasiswa Tahfidz Quran
4. Beasiswa Yatim Piatu

Persyaratan dan informasi lengkap dapat menghubungi bagian PPDB di sekolah atau melalui nomor telepon (0341) 123456.',
                'foto_pengumuman' => '',
                'status' => true,
                'urutan' => 3,
            ],
            [
                'nama_pengumuman' => 'Open House dan Try Out PPDB 2025',
                'deskripsi_pengumuman' => 'SMK Muhammadiyah 1 Berbek mengundang siswa-siswi kelas IX SMP/MTs untuk mengikuti kegiatan Open House dan Try Out PPDB 2025/2026.

Kegiatan:
- Tour fasilitas sekolah
- Demo jurusan
- Try out gratis
- Konsultasi pemilihan jurusan
- Workshop keterampilan

Waktu: Sabtu, 10 Januari 2025
Pukul: 08.00 - 12.00 WIB
Tempat: Kampus SMK Muhammadiyah 1 Berbek

Daftarkan diri Anda melalui link: bit.ly/openhouse-smkmuh1berbek
atau hubungi: 0857-1234-5678 (Bu Siti)',
                'foto_pengumuman' => '',
                'status' => true,
                'urutan' => 2,
            ],
                        [
                'nama_pengumuman' => 'Libur Semester Genap Tahun Ajaran 2023/2024',
                'deskripsi_pengumuman' => 'Diberitahukan kepada seluruh siswa, orang tua/wali, dan guru SMK Muhammadiyah 1 Berbek bahwa libur semester genap tahun ajaran 2023/2024 akan dilaksanakan mulai:

Tanggal: 15 Juni 2024 - 14 Juli 2024
Masuk kembali: Senin, 15 Juli 2024

Selama masa liburan, diharapkan:
1. Siswa dapat memanfaatkan waktu untuk istirahat dan berkumpul dengan keluarga
2. Tetap belajar mandiri dan membaca buku pelajaran
3. Menjaga kesehatan dan keselamatan diri
4. Mengikuti kegiatan positif di lingkungan masyarakat

Bagi siswa kelas X dan XI, persiapan untuk tahun ajaran baru 2024/2025:
- Memperbaiki nilai yang belum tuntas
- Mempersiapkan perlengkapan belajar
- Membaca materi pelajaran kelas berikutnya

Selamat berlibur, semoga dapat memanfaatkan waktu dengan baik dan kembali dengan semangat baru!',
                'foto_pengumuman' => '',
                'status' => true,
                'urutan' => 1,
            ],
        ];

        foreach ($pengumumen as $pengumuman) {
            Pengumuman::create($pengumuman);
        }

        $this->command->info('5 data pengumuman berhasil ditambahkan!');
    }
}