<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManajemenAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::where('id', '!=', auth()->guard('admin')->id())->get();
        return view('admin.manajemen-admin.index', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'nomor_telepon' => 'nullable|string|max:15',
            'password' => 'required|min:6|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB',
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
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomor_telepon' => $request->nomor_telepon,
            ];

            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/photo'), $fileName);
                $data['foto_profil'] = $fileName;
            }

            $admin = Admin::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil ditambahkan!',
                'admin' => [
                    'id' => $admin->id,
                    'nama_lengkap' => $admin->nama_lengkap,
                    'email' => $admin->email,
                    'nomor_telepon' => $admin->nomor_telepon,
                    'foto_profil' => $admin->foto_profil ? asset('images/photo/' . $admin->foto_profil) : null,
                    'created_at' => $admin->created_at->format('d M Y'),
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
    public function show(Admin $admin)
    {
        return response()->json([
            'success' => true,
            'admin' => [
                'id' => $admin->id,
                'nama_lengkap' => $admin->nama_lengkap,
                'email' => $admin->email,
                'nomor_telepon' => $admin->nomor_telepon,
                'foto_profil' => $admin->foto_profil ? asset('images/photo/' . $admin->foto_profil) : null,
                'created_at' => $admin->created_at->format('d F Y'),
                'updated_at' => $admin->updated_at->format('d F Y'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id)
            ],
            'nomor_telepon' => 'nullable|string|max:15',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB',
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
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'nomor_telepon' => $request->nomor_telepon,
            ];

            // Handle foto profil upload
            if ($request->hasFile('foto_profil')) {
                // Hapus foto lama jika ada
                if ($admin->foto_profil && file_exists(public_path('images/photo/' . $admin->foto_profil))) {
                    unlink(public_path('images/photo/' . $admin->foto_profil));
                }

                $file = $request->file('foto_profil');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/photo'), $fileName);
                $data['foto_profil'] = $fileName;
            }

            $admin->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data admin berhasil diperbarui!',
                'admin' => [
                    'id' => $admin->id,
                    'nama_lengkap' => $admin->nama_lengkap,
                    'email' => $admin->email,
                    'nomor_telepon' => $admin->nomor_telepon,
                    'foto_profil' => $admin->foto_profil ? asset('images/photo/' . $admin->foto_profil) : null,
                    'updated_at' => $admin->updated_at->format('d M Y'),
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
    public function destroy(Admin $admin)
    {
        try {
            if ($admin->foto_profil && file_exists(public_path('images/photo/' . $admin->foto_profil))) {
                unlink(public_path('images/photo/' . $admin->foto_profil));
            }

            $admin->delete();

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update password for admin
     */
    public function updatePassword(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $admin->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password admin berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}