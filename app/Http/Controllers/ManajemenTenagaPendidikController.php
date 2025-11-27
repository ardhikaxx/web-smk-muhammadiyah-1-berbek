<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManajemenTenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajars = Pengajar::ordered()->get();
        return view('admin.tenaga-pendidik.index', compact('pengajars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengajar' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'foto_pengajar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_pengajar.required' => 'Nama pengajar harus diisi',
            'nama_pengajar.max' => 'Nama pengajar maksimal 255 karakter',
            'nip.max' => 'NIP maksimal 50 karakter',
            'jabatan.required' => 'Jabatan harus diisi',
            'jabatan.max' => 'Jabatan maksimal 255 karakter',
            'foto_pengajar.image' => 'File harus berupa gambar',
            'foto_pengajar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_pengajar.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_pengajar' => $request->nama_pengajar,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ];

            // Handle foto upload jika ada
            if ($request->hasFile('foto_pengajar')) {
                $file = $request->file('foto_pengajar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/guru'), $fileName);
                $data['foto_pengajar'] = $fileName;
            }

            $pengajar = Pengajar::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Tenaga pendidik berhasil ditambahkan!',
                'pengajar' => [
                    'id' => $pengajar->id,
                    'nama_pengajar' => $pengajar->nama_pengajar,
                    'nip' => $pengajar->nip,
                    'jabatan' => $pengajar->jabatan,
                    'jabatan_pendek' => $pengajar->jabatan_pendek,
                    'foto_pengajar_url' => $pengajar->foto_pengajar_url,
                    'status' => $pengajar->status,
                    'urutan' => $pengajar->urutan,
                    'created_at' => $pengajar->created_at->format('d M Y'),
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
    public function show(Pengajar $pengajar)
    {
        return response()->json([
            'success' => true,
            'pengajar' => [
                'id' => $pengajar->id,
                'nama_pengajar' => $pengajar->nama_pengajar,
                'nip' => $pengajar->nip,
                'jabatan' => $pengajar->jabatan,
                'foto_pengajar_url' => $pengajar->foto_pengajar_url,
                'status' => $pengajar->status,
                'urutan' => $pengajar->urutan,
                'created_at' => $pengajar->created_at->format('d F Y'),
                'updated_at' => $pengajar->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajar $pengajar)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengajar' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'foto_pengajar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_pengajar.required' => 'Nama pengajar harus diisi',
            'nama_pengajar.max' => 'Nama pengajar maksimal 255 karakter',
            'nip.max' => 'NIP maksimal 50 karakter',
            'jabatan.required' => 'Jabatan harus diisi',
            'jabatan.max' => 'Jabatan maksimal 255 karakter',
            'foto_pengajar.image' => 'File harus berupa gambar',
            'foto_pengajar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_pengajar.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_pengajar' => $request->nama_pengajar,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'status' => $request->status ?? $pengajar->status,
                'urutan' => $request->urutan ?? $pengajar->urutan,
            ];

            // Handle foto upload jika ada
            if ($request->hasFile('foto_pengajar')) {
                // Hapus foto lama jika ada dan bukan default
                if ($pengajar->foto_pengajar && 
                    $pengajar->foto_pengajar !== 'default.jpg' &&
                    file_exists(public_path('images/guru/' . $pengajar->foto_pengajar))) {
                    unlink(public_path('images/guru/' . $pengajar->foto_pengajar));
                }

                $file = $request->file('foto_pengajar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/guru'), $fileName);
                $data['foto_pengajar'] = $fileName;
            }

            $pengajar->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Tenaga pendidik berhasil diperbarui!',
                'pengajar' => [
                    'id' => $pengajar->id,
                    'nama_pengajar' => $pengajar->nama_pengajar,
                    'nip' => $pengajar->nip,
                    'jabatan' => $pengajar->jabatan,
                    'jabatan_pendek' => $pengajar->jabatan_pendek,
                    'foto_pengajar_url' => $pengajar->foto_pengajar_url,
                    'status' => $pengajar->status,
                    'urutan' => $pengajar->urutan,
                    'updated_at' => $pengajar->updated_at->format('d M Y'),
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
    public function destroy(Pengajar $pengajar)
    {
        try {
            // Hapus foto dari storage jika bukan default
            if ($pengajar->foto_pengajar && 
                $pengajar->foto_pengajar !== 'default.jpg' &&
                file_exists(public_path('images/guru/' . $pengajar->foto_pengajar))) {
                unlink(public_path('images/guru/' . $pengajar->foto_pengajar));
            }

            $pengajar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tenaga pendidik berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update pengajar status
     */
    public function updateStatus(Request $request, Pengajar $pengajar)
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
            $pengajar->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status tenaga pendidik berhasil diperbarui!',
                'pengajar' => [
                    'id' => $pengajar->id,
                    'status' => $pengajar->status,
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