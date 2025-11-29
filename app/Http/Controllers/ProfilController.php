<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Pengajar;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Struktur;

class ProfilController extends Controller
{
    public function index()
    {
        $jumlahFasilitas = Fasilitas::active()->count();
        $jumlahPengajar = Pengajar::active()->count();
        $jumlahJurusan = Jurusan::active()->count();
        $jumlahPrestasi = Prestasi::active()->count();
        $banners = Banner::active()->ordered()->get();
        $pengajars = Pengajar::active()->ordered()->get();
        $struktur = Struktur::active()->first();

        return view('profil', compact(
            'banners',
            'pengajars',
            'jumlahPengajar',
            'jumlahJurusan',
            'jumlahFasilitas',
            'jumlahPrestasi',
            'struktur'
        ));
    }
}