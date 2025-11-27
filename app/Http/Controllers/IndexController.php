<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Fasilitas;
use App\Models\Gallery;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->ordered()->get();
        $fasilitas = Fasilitas::active()->ordered()->get();
        $galleries = Gallery::active()->ordered()->get();
        
        return view('index', compact('banners', 'fasilitas', 'galleries'));
    }
}