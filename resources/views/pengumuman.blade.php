<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - SMK Muhammadiyah 1 Berbek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logo-single.png') }}" type="image/x-icon">

    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004d99;
            --primary-light: #4d94ff;
            --secondary: #00a8ff;
            --accent: #ff6b6b;
            --accent-light: #ff9999;
            --dark: #1a1a2e;
            --darker: #0d0d1a;
            --light: #f8f9fa;
            --lighter: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary), var(--secondary));
            --gradient-dark: linear-gradient(135deg, var(--primary-dark), #0097e6);
            --gradient-accent: linear-gradient(135deg, var(--accent), #ff8e8e);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.7;
            color: #333;
            overflow-x: hidden;
            background-color: var(--lighter);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.3;
        }

        .section-padding {
            padding: 30px 0;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            position: relative;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100px;
            height: 5px;
            background: var(--gradient);
            border-radius: 10px;
        }

        .section-title.center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .section-subtitle {
            font-size: 1.3rem;
            color: #6c757d;
            margin-bottom: 3rem;
            max-width: 700px;
            font-weight: 400;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 18px 0;
            transition: var(--transition);
        }

        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            transition: var(--transition);
            border-radius: 8px;
        }

        .footer-logo img {
            border-radius: 10px;
        }

        @media (max-width: 575.98px) {
            .navbar-brand img {
                height: 70px !important;
            }

            .footer-logo img {
                height: 85px !important;
            }
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            margin: 0 8px;
            position: relative;
            color: var(--dark);
            transition: var(--transition);
            padding: 8px 16px !important;
            border-radius: 16px;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--gradient);
            border-radius: 10px;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary);
            background: rgba(0, 102, 204, 0.05);
        }

        .navbar-nav .nav-link:hover::before,
        .navbar-nav .nav-link.active::before {
            width: 30px;
        }

        .navbar-toggler {
            border: none;
            padding: 8px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Pengumuman Card Styles */
        .pengumuman-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            background: white;
            position: relative;
            z-index: 1;
        }

        .pengumuman-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
            z-index: 2;
        }

        .pengumuman-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-lg);
        }

        .pengumuman-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .pengumuman-card:hover .pengumuman-image {
            transform: scale(1.05);
        }

        .pengumuman-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-light);
            color: white;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: var(--shadow);
            z-index: 3;
        }

        .pengumuman-content {
            padding: 25px;
        }

        .pengumuman-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .pengumuman-description {
            color: #6c757d;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .pengumuman-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pengumuman-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .pengumuman-meta-item i {
            color: var(--primary);
        }

        .pengumuman-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pengumuman-status.active {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .pengumuman-status.inactive {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        /* Filter Styles */
        .filter-section {
            background: var(--light);
            padding: 60px 0 30px;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e0e0e0;
            color: #6c757d;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            margin: 5px;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--gradient);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .empty-state-text {
            color: #6c757d;
            font-size: 1.2rem;
        }

        /* Footer */
        .footer-section {
            background: var(--darker);
            color: white;
            padding: 100px 0 30px;
            position: relative;
        }

        .footer-logo {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .footer-about {
            margin-bottom: 30px;
            opacity: 0.8;
            line-height: 1.8;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            transition: var(--transition);
            font-size: 1.2rem;
            text-decoration: none;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-5px);
        }

        .footer-heading {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient);
            border-radius: 10px;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .footer-links a i {
            margin-right: 10px;
            font-size: 0.9rem;
            opacity: 0.7;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            padding-left: 8px;
        }

        .footer-links a:hover i {
            opacity: 1;
            transform: translateX(3px);
        }

        .footer-contact li {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }

        .footer-contact i {
            margin-right: 15px;
            color: var(--secondary);
            margin-top: 5px;
            font-size: 1.1rem;
        }

        .map-container {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            height: 250px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 25px;
            margin-top: 60px;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            background: var(--gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            cursor: pointer;
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        /* Loading Animation */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader {
            width: 80px;
            height: 80px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 20px;
        }

        .loading-text {
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1199.98px) {
            .section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .section-padding {
                padding: 30px 0;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .navbar-collapse {
                background: white;
                border-radius: 16px;
                padding: 20px;
                box-shadow: var(--shadow-lg);
                margin-top: 15px;
            }
        }

        @media (max-width: 767.98px) {
            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1.1rem;
            }

            .pengumuman-card {
                margin-bottom: 25px;
            }

            .pengumuman-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .footer-section {
                padding: 60px 0 20px;
            }

            .back-to-top {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }
        }

        @media (max-width: 575.98px) {
            .section-title {
                font-size: 1.8rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="loading-screen">
        <div class="loader"></div>
        <div class="loading-text">SMK Muhammadiyah 1 Berbek Nganjuk</div>
    </div>

    <div class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </div>

    <header class="header-section">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('landing-page') }}">
                    <img src="{{ asset('images/logo-black.png') }}" alt="SMK Muhammadiyah 1 Berbek" height="68"
                        class="d-inline-block align-text-center">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing-page') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('pengumuman') }}">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profil') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('prestasi') }}">Prestasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing-page') }}#jurusan">Jurusan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing-page') }}#fasilitas">Fasilitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing-page') }}#galeri">Galeri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="hero-section" style="background: var(--gradient-dark); padding: 130px 0 40px;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white mt-4">
                    <h1 class="hero-title animate__animated animate__fadeInUp">Pengumuman</h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Informasi terbaru dan pengumuman penting dari SMK Muhammadiyah 1 Berbek
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @if ($pengumuman->count() > 0)
                <div class="row" id="pengumuman-grid">
                    @foreach ($pengumuman as $item)
                        <div class="col-lg-4 col-md-6 mb-4 pengumuman-item">
                            <div class="pengumuman-card animate__animated animate__fadeInUp">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ $item->foto_pengumuman_url }}" class="pengumuman-image"
                                        alt="{{ $item->nama_pengumuman }}"
                                        onerror="this.src='{{ asset('images/default-img.png') }}'">
                                    <div class="pengumuman-badge">
                                        <i class="fas fa-bullhorn me-1"></i> Pengumuman
                                    </div>
                                </div>
                                <div class="pengumuman-content">
                                    <h4 class="pengumuman-title">{{ $item->nama_pengumuman }}</h4>
                                    <p class="pengumuman-description">
                                        {{ $item->deskripsi_pendek }}
                                    </p>
                                    <div class="pengumuman-meta">
                                        <div class="pengumuman-meta-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="pengumuman-status {{ $item->status ? 'active' : 'inactive' }}">
                                            <i class="fas fa-circle"></i>
                                            {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="text-muted">Belum Ada Pengumuman</h3>
                    <p class="empty-state-text">Pengumuman akan segera ditampilkan di sini.</p>
                </div>
            @endif
        </div>
    </section>

    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo-white.png') }}" alt="SMK Muhammadiyah 1 Berbek"
                            height="100" class="d-inline-block align-text-top me-3">
                    </div>
                    <p class="footer-about">Sekolah Menengah Kejuruan yang berkomitmen untuk menghasilkan lulusan yang
                        kompeten, berakhlak mulia, dan siap menghadapi tantangan dunia kerja.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5">
                    <h5 class="footer-heading">Tautan Cepat</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('landing-page') }}"><i class="fas fa-chevron-right"></i> Beranda</a>
                        </li>
                        <li><a href="{{ route('profil') }}"><i class="fas fa-chevron-right"></i> Profil Sekolah</a>
                        </li>
                        <li><a href="{{ route('prestasi') }}"><i class="fas fa-chevron-right"></i> Prestasi</a></li>
                        <li><a href="{{ route('pengumuman') }}"><i class="fas fa-chevron-right"></i> Pengumuman</a></li>
                        <li><a href="{{ route('landing-page') }}#jurusan"><i class="fas fa-chevron-right"></i>
                                Program Jurusan</a></li>
                        <li><a href="{{ route('landing-page') }}#fasilitas"><i class="fas fa-chevron-right"></i>
                                Fasilitas</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="footer-heading">Kontak Kami</h5>
                    <ul class="list-unstyled footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>JL. DERMOJOYO 26 SENGKUT, Sengkut, Berbek, Kabupaten Nganjuk Jawa Timur 64473</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>(0358) 323580</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>smkm1berbek@yahoo.com</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Senin - Jumat: 07.00 - 16.00 WIB</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-5">
                    <h5 class="footer-heading">Peta Lokasi</h5>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4850.088416523539!2d111.8658284114012!3d-7.660318592324255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e784cc883add2ff%3A0x10bd624bf559e6d8!2sSMK%20MUHAMADIYAH%201%20BERBEK!5e1!3m2!1sid!2sid!4v1764033282768!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-12 text-md-center text-center">
                        <p class="mb-0">&copy; {{ date('Y') }} SMK Muhammadiyah 1 Berbek Nganjuk. All rights
                            reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            const loadingScreen = document.querySelector('.loading-screen');
            setTimeout(() => {
                loadingScreen.classList.add('hidden');
            }, 1500);
        });

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }

            const backToTop = document.querySelector('.back-to-top');
            if (window.scrollY > 300) {
                backToTop.classList.add('active');
            } else {
                backToTop.classList.remove('active');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });

                    const navbarToggler = document.querySelector('.navbar-toggler');
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                }
            });
        });

        document.querySelector('.back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animate on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.pengumuman-card');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        document.querySelectorAll('.pengumuman-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>

</html>