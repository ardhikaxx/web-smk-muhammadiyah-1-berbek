<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManajemenPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumen = Pengumuman::ordered()->get();
        return view('admin.manajemen-pengumuman.index', compact('pengumumen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengumuman' => 'required|string|max:255',
            'deskripsi_pengumuman' => 'required|string|max:1000',
            'foto_pengumuman' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_pengumuman.required' => 'Nama pengumuman harus diisi',
            'nama_pengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
            'deskripsi_pengumuman.required' => 'Deskripsi pengumuman harus diisi',
            'deskripsi_pengumuman.max' => 'Deskripsi pengumuman maksimal 1000 karakter',
            'foto_pengumuman.required' => 'Foto pengumuman harus diisi',
            'foto_pengumuman.image' => 'File harus berupa gambar',
            'foto_pengumuman.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_pengumuman.max' => 'Ukuran gambar maksimal 5MB',
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
            if ($request->hasFile('foto_pengumuman')) {
                $file = $request->file('foto_pengumuman');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/pengumuman'), $fileName);
            }

            $pengumuman = Pengumuman::create([
                'nama_pengumuman' => $request->nama_pengumuman,
                'deskripsi_pengumuman' => $request->deskripsi_pengumuman,
                'foto_pengumuman' => $fileName,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil ditambahkan!',
                'pengumuman' => [
                    'id' => $pengumuman->id,
                    'nama_pengumuman' => $pengumuman->nama_pengumuman,
                    'deskripsi_pengumuman' => $pengumuman->deskripsi_pengumuman,
                    'deskripsi_pendek' => $pengumuman->deskripsi_pendek,
                    'foto_pengumuman_url' => $pengumuman->foto_pengumuman_url,
                    'status' => $pengumuman->status,
                    'urutan' => $pengumuman->urutan,
                    'created_at' => $pengumuman->created_at->format('d M Y'),
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
    public function show(Pengumuman $pengumuman)
    {
        return response()->json([
            'success' => true,
            'pengumuman' => [
                'id' => $pengumuman->id,
                'nama_pengumuman' => $pengumuman->nama_pengumuman,
                'deskripsi_pengumuman' => $pengumuman->deskripsi_pengumuman,
                'foto_pengumuman_url' => $pengumuman->foto_pengumuman_url,
                'status' => $pengumuman->status,
                'urutan' => $pengumuman->urutan,
                'created_at' => $pengumuman->created_at->format('d F Y'),
                'updated_at' => $pengumuman->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengumuman' => 'required|string|max:255',
            'deskripsi_pengumuman' => 'required|string|max:1000',
            'foto_pengumuman' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_pengumuman.required' => 'Nama pengumuman harus diisi',
            'nama_pengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
            'deskripsi_pengumuman.required' => 'Deskripsi pengumuman harus diisi',
            'deskripsi_pengumuman.max' => 'Deskripsi pengumuman maksimal 1000 karakter',
            'foto_pengumuman.image' => 'File harus berupa gambar',
            'foto_pengumuman.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_pengumuman.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_pengumuman' => $request->nama_pengumuman,
                'deskripsi_pengumuman' => $request->deskripsi_pengumuman,
                'status' => $request->status ?? $pengumuman->status,
                'urutan' => $request->urutan ?? $pengumuman->urutan,
            ];

            // Handle foto upload jika ada
            if ($request->hasFile('foto_pengumuman')) {
                // Hapus foto lama jika ada
                if ($pengumuman->foto_pengumuman && file_exists(public_path('images/pengumuman/' . $pengumuman->foto_pengumuman))) {
                    unlink(public_path('images/pengumuman/' . $pengumuman->foto_pengumuman));
                }

                $file = $request->file('foto_pengumuman');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/pengumuman'), $fileName);
                $data['foto_pengumuman'] = $fileName;
            }

            $pengumuman->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil diperbarui!',
                'pengumuman' => [
                    'id' => $pengumuman->id,
                    'nama_pengumuman' => $pengumuman->nama_pengumuman,
                    'deskripsi_pengumuman' => $pengumuman->deskripsi_pengumuman,
                    'deskripsi_pendek' => $pengumuman->deskripsi_pendek,
                    'foto_pengumuman_url' => $pengumuman->foto_pengumuman_url,
                    'status' => $pengumuman->status,
                    'urutan' => $pengumuman->urutan,
                    'updated_at' => $pengumuman->updated_at->format('d M Y'),
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
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            // Hapus foto dari storage
            if ($pengumuman->foto_pengumuman && file_exists(public_path('images/pengumuman/' . $pengumuman->foto_pengumuman))) {
                unlink(public_path('images/pengumuman/' . $pengumuman->foto_pengumuman));
            }

            $pengumuman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update pengumuman status
     */
    public function updateStatus(Request $request, Pengumuman $pengumuman)
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
            $pengumuman->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pengumuman berhasil diperbarui!',
                'pengumuman' => [
                    'id' => $pengumuman->id,
                    'status' => $pengumuman->status,
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