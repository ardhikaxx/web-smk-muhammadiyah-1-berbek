<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManajemenFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::ordered()->get();
        return view('admin.manajemen-fasilitas.index', compact('fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string|max:1000',
            'foto_fasilitas' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas harus diisi',
            'nama_fasilitas.max' => 'Nama fasilitas maksimal 255 karakter',
            'deskripsi_fasilitas.required' => 'Deskripsi fasilitas harus diisi',
            'deskripsi_fasilitas.max' => 'Deskripsi fasilitas maksimal 1000 karakter',
            'foto_fasilitas.required' => 'Foto fasilitas harus diisi',
            'foto_fasilitas.image' => 'File harus berupa gambar',
            'foto_fasilitas.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_fasilitas.max' => 'Ukuran gambar maksimal 5MB',
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
            if ($request->hasFile('foto_fasilitas')) {
                $file = $request->file('foto_fasilitas');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/fasilitas'), $fileName);
            }

            $fasilitas = Fasilitas::create([
                'nama_fasilitas' => $request->nama_fasilitas,
                'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
                'foto_fasilitas' => $fileName,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Fasilitas berhasil ditambahkan!',
                'fasilitas' => [
                    'id' => $fasilitas->id,
                    'nama_fasilitas' => $fasilitas->nama_fasilitas,
                    'deskripsi_fasilitas' => $fasilitas->deskripsi_fasilitas,
                    'deskripsi_pendek' => $fasilitas->deskripsi_pendek,
                    'foto_fasilitas_url' => $fasilitas->foto_fasilitas_url,
                    'status' => $fasilitas->status,
                    'urutan' => $fasilitas->urutan,
                    'created_at' => $fasilitas->created_at->format('d M Y'),
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
    public function show(Fasilitas $fasilitas)
    {
        return response()->json([
            'success' => true,
            'fasilitas' => [
                'id' => $fasilitas->id,
                'nama_fasilitas' => $fasilitas->nama_fasilitas,
                'deskripsi_fasilitas' => $fasilitas->deskripsi_fasilitas,
                'foto_fasilitas_url' => $fasilitas->foto_fasilitas_url,
                'status' => $fasilitas->status,
                'urutan' => $fasilitas->urutan,
                'created_at' => $fasilitas->created_at->format('d F Y'),
                'updated_at' => $fasilitas->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string|max:1000',
            'foto_fasilitas' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas harus diisi',
            'nama_fasilitas.max' => 'Nama fasilitas maksimal 255 karakter',
            'deskripsi_fasilitas.required' => 'Deskripsi fasilitas harus diisi',
            'deskripsi_fasilitas.max' => 'Deskripsi fasilitas maksimal 1000 karakter',
            'foto_fasilitas.image' => 'File harus berupa gambar',
            'foto_fasilitas.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_fasilitas.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_fasilitas' => $request->nama_fasilitas,
                'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
                'status' => $request->status ?? $fasilitas->status,
                'urutan' => $request->urutan ?? $fasilitas->urutan,
            ];

            if ($request->hasFile('foto_fasilitas')) {
                if ($fasilitas->foto_fasilitas && file_exists(public_path('images/fasilitas/' . $fasilitas->foto_fasilitas))) {
                    unlink(public_path('images/fasilitas/' . $fasilitas->foto_fasilitas));
                }

                $file = $request->file('foto_fasilitas');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/fasilitas'), $fileName);
                $data['foto_fasilitas'] = $fileName;
            }

            $fasilitas->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Fasilitas berhasil diperbarui!',
                'fasilitas' => [
                    'id' => $fasilitas->id,
                    'nama_fasilitas' => $fasilitas->nama_fasilitas,
                    'deskripsi_fasilitas' => $fasilitas->deskripsi_fasilitas,
                    'deskripsi_pendek' => $fasilitas->deskripsi_pendek,
                    'foto_fasilitas_url' => $fasilitas->foto_fasilitas_url,
                    'status' => $fasilitas->status,
                    'urutan' => $fasilitas->urutan,
                    'updated_at' => $fasilitas->updated_at->format('d M Y'),
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
    public function destroy(Fasilitas $fasilitas)
    {
        try {
            if ($fasilitas->foto_fasilitas && file_exists(public_path('images/fasilitas/' . $fasilitas->foto_fasilitas))) {
                unlink(public_path('images/fasilitas/' . $fasilitas->foto_fasilitas));
            }

            $fasilitas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Fasilitas berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update fasilitas status
     */
    public function updateStatus(Request $request, Fasilitas $fasilitas)
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
            $fasilitas->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status fasilitas berhasil diperbarui!',
                'fasilitas' => [
                    'id' => $fasilitas->id,
                    'status' => $fasilitas->status,
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