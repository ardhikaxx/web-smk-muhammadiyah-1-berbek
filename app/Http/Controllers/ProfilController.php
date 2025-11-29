<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Pengajar;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Prestasi;

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
        return view('profil', compact(
            'banners',
            'pengajars',
            'jumlahPengajar',
            'jumlahJurusan',
            'jumlahFasilitas',
            'jumlahPrestasi',
        ));
    }
}