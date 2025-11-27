<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManajemenGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::ordered()->get();
        return view('admin.manajemen-gallery.index', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_gallery' => 'required|string|max:255',
            'deskripsi_gallery' => 'required|string|max:1000',
            'foto_gallery' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_gallery.required' => 'Nama gallery harus diisi',
            'nama_gallery.max' => 'Nama gallery maksimal 255 karakter',
            'deskripsi_gallery.required' => 'Deskripsi gallery harus diisi',
            'deskripsi_gallery.max' => 'Deskripsi gallery maksimal 1000 karakter',
            'foto_gallery.required' => 'Foto gallery harus diisi',
            'foto_gallery.image' => 'File harus berupa gambar',
            'foto_gallery.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_gallery.max' => 'Ukuran gambar maksimal 5MB',
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
            // Handle foto upload
            if ($request->hasFile('foto_gallery')) {
                $file = $request->file('foto_gallery');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/gallery'), $fileName);
            }

            $gallery = Gallery::create([
                'nama_gallery' => $request->nama_gallery,
                'deskripsi_gallery' => $request->deskripsi_gallery,
                'foto_gallery' => $fileName,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Gallery berhasil ditambahkan!',
                'gallery' => [
                    'id' => $gallery->id,
                    'nama_gallery' => $gallery->nama_gallery,
                    'deskripsi_gallery' => $gallery->deskripsi_gallery,
                    'deskripsi_pendek' => $gallery->deskripsi_pendek,
                    'foto_gallery_url' => $gallery->foto_gallery_url,
                    'status' => $gallery->status,
                    'urutan' => $gallery->urutan,
                    'created_at' => $gallery->created_at->format('d M Y'),
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
    public function show(Gallery $gallery)
    {
        return response()->json([
            'success' => true,
            'gallery' => [
                'id' => $gallery->id,
                'nama_gallery' => $gallery->nama_gallery,
                'deskripsi_gallery' => $gallery->deskripsi_gallery,
                'foto_gallery_url' => $gallery->foto_gallery_url,
                'status' => $gallery->status,
                'urutan' => $gallery->urutan,
                'created_at' => $gallery->created_at->format('d F Y'),
                'updated_at' => $gallery->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'nama_gallery' => 'required|string|max:255',
            'deskripsi_gallery' => 'required|string|max:1000',
            'foto_gallery' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_gallery.required' => 'Nama gallery harus diisi',
            'nama_gallery.max' => 'Nama gallery maksimal 255 karakter',
            'deskripsi_gallery.required' => 'Deskripsi gallery harus diisi',
            'deskripsi_gallery.max' => 'Deskripsi gallery maksimal 1000 karakter',
            'foto_gallery.image' => 'File harus berupa gambar',
            'foto_gallery.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_gallery.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_gallery' => $request->nama_gallery,
                'deskripsi_gallery' => $request->deskripsi_gallery,
                'status' => $request->status ?? $gallery->status,
                'urutan' => $request->urutan ?? $gallery->urutan,
            ];

            // Handle foto upload jika ada
            if ($request->hasFile('foto_gallery')) {
                // Hapus foto lama jika ada
                if ($gallery->foto_gallery && file_exists(public_path('images/gallery/' . $gallery->foto_gallery))) {
                    unlink(public_path('images/gallery/' . $gallery->foto_gallery));
                }

                $file = $request->file('foto_gallery');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/gallery'), $fileName);
                $data['foto_gallery'] = $fileName;
            }

            $gallery->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Gallery berhasil diperbarui!',
                'gallery' => [
                    'id' => $gallery->id,
                    'nama_gallery' => $gallery->nama_gallery,
                    'deskripsi_gallery' => $gallery->deskripsi_gallery,
                    'deskripsi_pendek' => $gallery->deskripsi_pendek,
                    'foto_gallery_url' => $gallery->foto_gallery_url,
                    'status' => $gallery->status,
                    'urutan' => $gallery->urutan,
                    'updated_at' => $gallery->updated_at->format('d M Y'),
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
    public function destroy(Gallery $gallery)
    {
        try {
            // Hapus foto dari storage
            if ($gallery->foto_gallery && file_exists(public_path('images/gallery/' . $gallery->foto_gallery))) {
                unlink(public_path('images/gallery/' . $gallery->foto_gallery));
            }

            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Gallery berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update gallery status
     */
    public function updateStatus(Request $request, Gallery $gallery)
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
            $gallery->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status gallery berhasil diperbarui!',
                'gallery' => [
                    'id' => $gallery->id,
                    'status' => $gallery->status,
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