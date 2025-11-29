<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Fasilitas;
use App\Models\Gallery;
use App\Models\Jurusan;
use App\Models\Pengajar;
use App\Models\Pengumuman;
use App\Models\Prestasi;

class IndexController extends Controller
{
    public function index()
    {
        $jumlahFasilitas = Fasilitas::active()->count();
        $jumlahPengajar = Pengajar::active()->count();
        $jumlahJurusan = Jurusan::active()->count();
        $jumlahPrestasi = Prestasi::active()->count();
        $banners = Banner::active()->ordered()->get();
        $pengumumans = Pengumuman::active()->ordered()->limit(5)->get();
        $fasilitas = Fasilitas::active()->ordered()->get();
        $galleries = Gallery::active()->ordered()->get();
        $jurusan = Jurusan::active()->ordered()->get();
        
        return view('index', compact('banners', 'fasilitas', 'galleries', 'jurusan', 'pengumumans', 'jumlahJurusan', 'jumlahPengajar', 'jumlahPrestasi', 'jumlahFasilitas'));
    }
}