<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Get current logged in admin
     */
    public function getCurrentAdmin()
    {
        $admin = Auth::guard('admin')->user();
        return response()->json([
            'success' => true,
            'admin' => [
                'id' => $admin->id,
                'nama_lengkap' => $admin->nama_lengkap,
                'email' => $admin->email,
                'foto_profil' => $admin->foto_profil ? asset('images/photo/' . $admin->foto_profil) : null,
            ]
        ]);
    }
    
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        // Coba login
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login berhasil! Selamat datang.');
        }

        return redirect()->back()
            ->with('error', 'Email atau password salah!')
            ->withInput($request->except('password'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')
            ->with('success', 'Logout berhasil!');
    }

    /**
     * Show admin registration form (optional - untuk membuat admin pertama)
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle admin registration (optional - untuk membuat admin pertama)
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'nomor_telepon' => 'nullable|string|max:15',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Handle foto profil upload
        $fotoProfil = null;
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/photo'), $fileName);
            $fotoProfil = $fileName;
        }

        // Create admin
        $admin = Admin::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'foto_profil' => $fotoProfil,
        ]);

        // Auto login after registration
        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}