<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pengajar;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Pengumuman;
use App\Models\Gallery;
use App\Models\Struktur;
use App\Models\Banner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJurusan = Jurusan::active()->count();
        $totalPengajar = Pengajar::active()->count();
        $totalFasilitas = Fasilitas::active()->count();
        $totalPrestasi = Prestasi::active()->count();
        $totalPengumuman = Pengumuman::active()->count();
        $totalGallery = Gallery::active()->count();
        $totalStruktur = Struktur::active()->count();
        $totalBanner = Banner::active()->count();

        $prestasiPerTahun = Prestasi::active()
            ->selectRaw('tahun_prestasi, COUNT(*) as total')
            ->groupBy('tahun_prestasi')
            ->orderBy('tahun_prestasi')
            ->get();

        $pengumumanPerBulan = Pengumuman::active()
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        $latestPrestasi = Prestasi::active()->ordered()->take(5)->get();
        $latestPengumuman = Pengumuman::active()->ordered()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalJurusan',
            'totalPengajar',
            'totalFasilitas',
            'totalPrestasi',
            'totalPengumuman',
            'totalGallery',
            'totalStruktur',
            'totalBanner',
            'prestasiPerTahun',
            'pengumumanPerBulan',
            'latestPrestasi',
            'latestPengumuman'
        ));
    }

    public function getChartData()
    {
        $prestasiData = Prestasi::active()
            ->selectRaw('tahun_prestasi, COUNT(*) as total')
            ->groupBy('tahun_prestasi')
            ->orderBy('tahun_prestasi')
            ->get();

        $labels = $prestasiData->pluck('tahun_prestasi');
        $data = $prestasiData->pluck('total');

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}