<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManajemenBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::ordered()->get();
        return view('admin.manajemen-banner.index', compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'gambar.required' => 'Gambar banner harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'gambar.max' => 'Ukuran gambar maksimal 5MB',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
            'urutan.integer' => 'Urutan harus berupa angka',
            'urutan.min' => 'Urutan minimal 0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banner'), $fileName);
            }

            $banner = Banner::create([
                'gambar' => $fileName,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil ditambahkan!',
                'banner' => [
                    'id' => $banner->id,
                    'gambar_url' => $banner->gambar_url,
                    'judul' => $banner->judul,
                    'deskripsi' => $banner->deskripsi,
                    'status' => $banner->status,
                    'urutan' => $banner->urutan,
                    'created_at' => $banner->created_at->format('d M Y'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return response()->json([
            'success' => true,
            'banner' => [
                'id' => $banner->id,
                'gambar_url' => $banner->gambar_url,
                'judul' => $banner->judul,
                'deskripsi' => $banner->deskripsi,
                'status' => $banner->status,
                'urutan' => $banner->urutan,
                'created_at' => $banner->created_at->format('d F Y'),
                'updated_at' => $banner->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'gambar.max' => 'Ukuran gambar maksimal 5MB',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
            'urutan.integer' => 'Urutan harus berupa angka',
            'urutan.min' => 'Urutan minimal 0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status ?? $banner->status,
                'urutan' => $request->urutan ?? $banner->urutan,
            ];

            if ($request->hasFile('gambar')) {
                if ($banner->gambar && file_exists(public_path('images/banner/' . $banner->gambar))) {
                    unlink(public_path('images/banner/' . $banner->gambar));
                }

                $file = $request->file('gambar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banner'), $fileName);
                $data['gambar'] = $fileName;
            }

            $banner->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil diperbarui!',
                'banner' => [
                    'id' => $banner->id,
                    'gambar_url' => $banner->gambar_url,
                    'judul' => $banner->judul,
                    'deskripsi' => $banner->deskripsi,
                    'status' => $banner->status,
                    'urutan' => $banner->urutan,
                    'updated_at' => $banner->updated_at->format('d M Y'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try {
            if ($banner->gambar && file_exists(public_path('images/banner/' . $banner->gambar))) {
                unlink(public_path('images/banner/' . $banner->gambar));
            }

            $banner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update banner status
     */
    public function updateStatus(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal'
            ], 422);
        }

        try {
            $banner->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status banner berhasil diperbarui!',
                'banner' => [
                    'id' => $banner->id,
                    'status' => $banner->status,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}