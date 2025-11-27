<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManajemenJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = Jurusan::ordered()->get();
        return view('admin.manajemen-jurusan.index', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:255',
            'deskripsi_jurusan' => 'required|string|max:1000',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_jurusan.required' => 'Nama jurusan harus diisi',
            'nama_jurusan.max' => 'Nama jurusan maksimal 255 karakter',
            'deskripsi_jurusan.required' => 'Deskripsi jurusan harus diisi',
            'deskripsi_jurusan.max' => 'Deskripsi jurusan maksimal 1000 karakter',
            'kode_jurusan.required' => 'Kode jurusan harus diisi',
            'kode_jurusan.max' => 'Kode jurusan maksimal 10 karakter',
            'kode_jurusan.unique' => 'Kode jurusan sudah digunakan',
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
            $jurusan = Jurusan::create([
                'nama_jurusan' => $request->nama_jurusan,
                'deskripsi_jurusan' => $request->deskripsi_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jurusan berhasil ditambahkan!',
                'jurusan' => [
                    'id' => $jurusan->id,
                    'nama_jurusan' => $jurusan->nama_jurusan,
                    'deskripsi_jurusan' => $jurusan->deskripsi_jurusan,
                    'deskripsi_pendek' => $jurusan->deskripsi_pendek,
                    'kode_jurusan' => $jurusan->kode_jurusan,
                    'kode_formatted' => $jurusan->kode_formatted,
                    'status' => $jurusan->status,
                    'urutan' => $jurusan->urutan,
                    'created_at' => $jurusan->created_at->format('d M Y'),
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
    public function show(Jurusan $jurusan)
    {
        return response()->json([
            'success' => true,
            'jurusan' => [
                'id' => $jurusan->id,
                'nama_jurusan' => $jurusan->nama_jurusan,
                'deskripsi_jurusan' => $jurusan->deskripsi_jurusan,
                'kode_jurusan' => $jurusan->kode_jurusan,
                'status' => $jurusan->status,
                'urutan' => $jurusan->urutan,
                'created_at' => $jurusan->created_at->format('d F Y'),
                'updated_at' => $jurusan->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:255',
            'deskripsi_jurusan' => 'required|string|max:1000',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan,' . $jurusan->id,
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_jurusan.required' => 'Nama jurusan harus diisi',
            'nama_jurusan.max' => 'Nama jurusan maksimal 255 karakter',
            'deskripsi_jurusan.required' => 'Deskripsi jurusan harus diisi',
            'deskripsi_jurusan.max' => 'Deskripsi jurusan maksimal 1000 karakter',
            'kode_jurusan.required' => 'Kode jurusan harus diisi',
            'kode_jurusan.max' => 'Kode jurusan maksimal 10 karakter',
            'kode_jurusan.unique' => 'Kode jurusan sudah digunakan',
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
            $jurusan->update([
                'nama_jurusan' => $request->nama_jurusan,
                'deskripsi_jurusan' => $request->deskripsi_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'status' => $request->status ?? $jurusan->status,
                'urutan' => $request->urutan ?? $jurusan->urutan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jurusan berhasil diperbarui!',
                'jurusan' => [
                    'id' => $jurusan->id,
                    'nama_jurusan' => $jurusan->nama_jurusan,
                    'deskripsi_jurusan' => $jurusan->deskripsi_jurusan,
                    'deskripsi_pendek' => $jurusan->deskripsi_pendek,
                    'kode_jurusan' => $jurusan->kode_jurusan,
                    'kode_formatted' => $jurusan->kode_formatted,
                    'status' => $jurusan->status,
                    'urutan' => $jurusan->urutan,
                    'updated_at' => $jurusan->updated_at->format('d M Y'),
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
    public function destroy(Jurusan $jurusan)
    {
        try {
            $jurusan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jurusan berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update jurusan status
     */
    public function updateStatus(Request $request, Jurusan $jurusan)
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
            $jurusan->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status jurusan berhasil diperbarui!',
                'jurusan' => [
                    'id' => $jurusan->id,
                    'status' => $jurusan->status,
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