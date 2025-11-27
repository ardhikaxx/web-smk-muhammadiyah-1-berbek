<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManajemenPrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestasis = Prestasi::ordered()->get();
        return view('admin.manajemen-prestasi.index', compact('prestasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nama_prestasi' => 'required|string|max:255',
            'peringkat' => 'required|string|max:100',
            'tahun_prestasi' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto_prestasi' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'nama_siswa.max' => 'Nama siswa maksimal 255 karakter',
            'jurusan.required' => 'Jurusan harus diisi',
            'jurusan.max' => 'Jurusan maksimal 255 karakter',
            'nama_prestasi.required' => 'Nama prestasi harus diisi',
            'nama_prestasi.max' => 'Nama prestasi maksimal 255 karakter',
            'peringkat.required' => 'Peringkat harus diisi',
            'peringkat.max' => 'Peringkat maksimal 100 karakter',
            'tahun_prestasi.required' => 'Tahun prestasi harus diisi',
            'tahun_prestasi.integer' => 'Tahun prestasi harus berupa angka',
            'tahun_prestasi.min' => 'Tahun prestasi minimal 2000',
            'tahun_prestasi.max' => 'Tahun prestasi maksimal ' . (date('Y') + 1),
            'foto_prestasi.required' => 'Foto prestasi harus diisi',
            'foto_prestasi.image' => 'File harus berupa gambar',
            'foto_prestasi.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_prestasi.max' => 'Ukuran gambar maksimal 5MB',
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
            if ($request->hasFile('foto_prestasi')) {
                $file = $request->file('foto_prestasi');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/prestasi'), $fileName);
            }

            $prestasi = Prestasi::create([
                'nama_siswa' => $request->nama_siswa,
                'jurusan' => $request->jurusan,
                'nama_prestasi' => $request->nama_prestasi,
                'peringkat' => $request->peringkat,
                'tahun_prestasi' => $request->tahun_prestasi,
                'foto_prestasi' => $fileName,
                'status' => $request->status ?? true,
                'urutan' => $request->urutan ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Prestasi berhasil ditambahkan!',
                'prestasi' => [
                    'id' => $prestasi->id,
                    'nama_siswa' => $prestasi->nama_siswa,
                    'jurusan' => $prestasi->jurusan,
                    'nama_prestasi' => $prestasi->nama_prestasi,
                    'peringkat' => $prestasi->peringkat,
                    'tahun_prestasi' => $prestasi->tahun_prestasi,
                    'foto_prestasi_url' => $prestasi->foto_prestasi_url,
                    'status' => $prestasi->status,
                    'urutan' => $prestasi->urutan,
                    'created_at' => $prestasi->created_at->format('d M Y'),
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
    public function show(Prestasi $prestasi)
    {
        return response()->json([
            'success' => true,
            'prestasi' => [
                'id' => $prestasi->id,
                'nama_siswa' => $prestasi->nama_siswa,
                'jurusan' => $prestasi->jurusan,
                'nama_prestasi' => $prestasi->nama_prestasi,
                'peringkat' => $prestasi->peringkat,
                'tahun_prestasi' => $prestasi->tahun_prestasi,
                'foto_prestasi_url' => $prestasi->foto_prestasi_url,
                'status' => $prestasi->status,
                'urutan' => $prestasi->urutan,
                'created_at' => $prestasi->created_at->format('d F Y'),
                'updated_at' => $prestasi->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nama_prestasi' => 'required|string|max:255',
            'peringkat' => 'required|string|max:100',
            'tahun_prestasi' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto_prestasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'nama_siswa.max' => 'Nama siswa maksimal 255 karakter',
            'jurusan.required' => 'Jurusan harus diisi',
            'jurusan.max' => 'Jurusan maksimal 255 karakter',
            'nama_prestasi.required' => 'Nama prestasi harus diisi',
            'nama_prestasi.max' => 'Nama prestasi maksimal 255 karakter',
            'peringkat.required' => 'Peringkat harus diisi',
            'peringkat.max' => 'Peringkat maksimal 100 karakter',
            'tahun_prestasi.required' => 'Tahun prestasi harus diisi',
            'tahun_prestasi.integer' => 'Tahun prestasi harus berupa angka',
            'tahun_prestasi.min' => 'Tahun prestasi minimal 2000',
            'tahun_prestasi.max' => 'Tahun prestasi maksimal ' . (date('Y') + 1),
            'foto_prestasi.image' => 'File harus berupa gambar',
            'foto_prestasi.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_prestasi.max' => 'Ukuran gambar maksimal 5MB',
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
                'nama_siswa' => $request->nama_siswa,
                'jurusan' => $request->jurusan,
                'nama_prestasi' => $request->nama_prestasi,
                'peringkat' => $request->peringkat,
                'tahun_prestasi' => $request->tahun_prestasi,
                'status' => $request->status ?? $prestasi->status,
                'urutan' => $request->urutan ?? $prestasi->urutan,
            ];

            // Handle foto upload jika ada
            if ($request->hasFile('foto_prestasi')) {
                // Hapus foto lama jika ada
                if ($prestasi->foto_prestasi && file_exists(public_path('images/prestasi/' . $prestasi->foto_prestasi))) {
                    unlink(public_path('images/prestasi/' . $prestasi->foto_prestasi));
                }

                $file = $request->file('foto_prestasi');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/prestasi'), $fileName);
                $data['foto_prestasi'] = $fileName;
            }

            $prestasi->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Prestasi berhasil diperbarui!',
                'prestasi' => [
                    'id' => $prestasi->id,
                    'nama_siswa' => $prestasi->nama_siswa,
                    'jurusan' => $prestasi->jurusan,
                    'nama_prestasi' => $prestasi->nama_prestasi,
                    'peringkat' => $prestasi->peringkat,
                    'tahun_prestasi' => $prestasi->tahun_prestasi,
                    'foto_prestasi_url' => $prestasi->foto_prestasi_url,
                    'status' => $prestasi->status,
                    'urutan' => $prestasi->urutan,
                    'updated_at' => $prestasi->updated_at->format('d M Y'),
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
    public function destroy(Prestasi $prestasi)
    {
        try {
            // Hapus foto dari storage
            if ($prestasi->foto_prestasi && file_exists(public_path('images/prestasi/' . $prestasi->foto_prestasi))) {
                unlink(public_path('images/prestasi/' . $prestasi->foto_prestasi));
            }

            $prestasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Prestasi berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update prestasi status
     */
    public function updateStatus(Request $request, Prestasi $prestasi)
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
            $prestasi->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status prestasi berhasil diperbarui!',
                'prestasi' => [
                    'id' => $prestasi->id,
                    'status' => $prestasi->status,
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