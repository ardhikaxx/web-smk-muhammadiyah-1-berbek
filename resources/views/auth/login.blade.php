@extends('layouts.auth')

@section('content')
<div class="login-container">
    <div class="login-background">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
    </div>
    
    <div class="login-card-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo-black.png') }}" alt="SMK Muhammadiyah 1 Berbek" class="login-logo">
                </div>
                <h2 class="login-title">Masuk ke Akun</h2>
                <p class="login-subtitle">Selamat datang kembali! Silakan masuk ke akun Anda</p>
            </div>

            <form class="login-form">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                        <button type="button" class="password-toggle border-0" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Masuk</span>
                    <i class="fas fa-arrow-right btn-icon"></i>
                </button>

                <div class="back-to-home">
                    <a href="{{ route('landing-page') }}" class="back-btn text-decoration-none">
                        <i class="fas fa-chevron-left"></i>
                        <span>Kembali ke Halaman Utama</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection