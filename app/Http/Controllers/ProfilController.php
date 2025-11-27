<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Pengajar;
use App\Models\Jurusan;

class ProfilController extends Controller
{
    public function index()
    {
        $jumlahPengajar = Pengajar::active()->count();
        $jumlahJurusan = Jurusan::active()->count();
        $banners = Banner::active()->ordered()->get();
        $pengajars = Pengajar::active()->ordered()->get();
        return view('profil', compact(
            'banners',
            'pengajars',
            'jumlahPengajar',
            'jumlahJurusan',
        ));
    }
}