<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManajemenStrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $strukturs = Struktur::ordered()->get();
        return view('admin.manajemen-struktur.index', compact('strukturs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar_struktur' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'gambar_struktur.required' => 'Gambar struktur harus diisi',
            'gambar_struktur.image' => 'File harus berupa gambar',
            'gambar_struktur.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'gambar_struktur.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('gambar_struktur')) {
                $file = $request->file('gambar_struktur');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/struktur'), $fileName);
            }

            $struktur = Struktur::create([
                'gambar_struktur' => $fileName,
                'status' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Struktur organisasi berhasil ditambahkan!',
                'struktur' => [
                    'id' => $struktur->id,
                    'gambar_struktur_url' => $struktur->gambar_struktur_url,
                    'status' => $struktur->status,
                    'created_at' => $struktur->created_at->format('d M Y'),
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
    public function show(Struktur $struktur)
    {
        return response()->json([
            'success' => true,
            'struktur' => [
                'id' => $struktur->id,
                'gambar_struktur_url' => $struktur->gambar_struktur_url,
                'status' => $struktur->status,
                'created_at' => $struktur->created_at->format('d F Y'),
                'updated_at' => $struktur->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Struktur $struktur)
    {
        $validator = Validator::make($request->all(), [
            'gambar_struktur' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'gambar_struktur.required' => 'Gambar struktur harus diisi',
            'gambar_struktur.image' => 'File harus berupa gambar',
            'gambar_struktur.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'gambar_struktur.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('gambar_struktur')) {
                if ($struktur->gambar_struktur && file_exists(public_path('images/struktur/' . $struktur->gambar_struktur))) {
                    unlink(public_path('images/struktur/' . $struktur->gambar_struktur));
                }

                $file = $request->file('gambar_struktur');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/struktur'), $fileName);
                
                $struktur->update([
                    'gambar_struktur' => $fileName,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Struktur organisasi berhasil diperbarui!',
                'struktur' => [
                    'id' => $struktur->id,
                    'gambar_struktur_url' => $struktur->gambar_struktur_url,
                    'status' => $struktur->status,
                    'updated_at' => $struktur->updated_at->format('d M Y'),
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
    public function destroy(Struktur $struktur)
    {
        try {
            if ($struktur->gambar_struktur && file_exists(public_path('images/struktur/' . $struktur->gambar_struktur))) {
                unlink(public_path('images/struktur/' . $struktur->gambar_struktur));
            }

            $struktur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Struktur organisasi berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update struktur status
     */
    public function updateStatus(Request $request, Struktur $struktur)
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
            $struktur->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status struktur berhasil diperbarui!',
                'struktur' => [
                    'id' => $struktur->id,
                    'status' => $struktur->status,
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