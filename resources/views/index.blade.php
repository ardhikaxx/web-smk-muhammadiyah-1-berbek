<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Muhammadiyah 1 Berbek - Sekolah Unggulan Berbasis Teknologi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.core.min.css">
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
            padding: 120px 0;
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

        .hero-section {
            background: var(--gradient-dark);
            color: white;
            padding: 180px 0 100px;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center bottom;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            max-width: 500px;
        }

        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            opacity: 0.8;
            max-width: 600px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 14px 35px;
            font-weight: 600;
            border-radius: 50px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
            box-shadow: var(--shadow);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: var(--transition);
            z-index: -1;
        }

        .btn:hover::before {
            width: 100%;
        }

        .btn-primary {
            background: var(--gradient);
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .btn-light {
            background: white;
            color: var(--primary);
        }

        .btn-light:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            color: var(--primary);
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: transparent;
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary);
            border-color: white;
        }

        .hero-carousel {
            position: relative;
            z-index: 1;
        }

        .hero-carousel .carousel-item img {
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-xl);
            border: 8px solid rgba(255, 255, 255, 0.1);
            height: 500px;
            object-fit: cover;
            width: 100%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: var(--transition);
        }

        .hero-carousel:hover .carousel-control-prev,
        .hero-carousel:hover .carousel-control-next {
            opacity: 1;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-indicators {
            bottom: -50px;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 20%;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
        }

        .carousel-indicators button.active {
            background-color: white;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 15%;
            animation-delay: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-25px) rotate(10deg);
            }
        }

        /* Stats Section */
        .stats-section {
            background-color: var(--light);
            padding: 100px 0;
            position: relative;
        }

        .stat-card {
            text-align: center;
            padding: 40px 30px;
            border-radius: var(--border-radius);
            background: white;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
            z-index: 2;
        }

        .stat-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 90px;
            height: 90px;
            background: var(--gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2.2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
            line-height: 1;
        }

        .stat-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        /* Jurusan Section */
        .jurusan-card {
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

        .jurusan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
            z-index: 2;
        }

        .jurusan-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-lg);
        }

        .jurusan-icon {
            width: 90px;
            height: 90px;
            background: var(--gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2.2rem;
            transform: rotate(-10deg);
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .jurusan-card:hover .jurusan-icon {
            transform: rotate(0) scale(1.1);
        }

        .jurusan-card .card-body {
            padding: 30px 25px;
        }

        .jurusan-card .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .jurusan-card .card-subtitle {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .jurusan-card .card-text {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .jurusan-badge {
            background: var(--gradient);
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        /* Fasilitas Section */
        .facility-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            position: relative;
        }

        .facility-card img {
            transition: transform 0.7s ease;
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .facility-card:hover img {
            transform: scale(1.1);
        }

        .facility-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
            padding: 30px 25px 25px;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .facility-card:hover .facility-overlay {
            transform: translateY(0);
        }

        .facility-card .card-body {
            padding: 25px;
        }

        .facility-card .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        /* PPDB Section */
        .ppdb-section {
            background: var(--gradient-dark);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .ppdb-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23000000" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center bottom;
        }

        .ppdb-info-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: var(--border-radius);
            padding: 30px 25px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .ppdb-info-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .ppdb-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 1.8rem;
            flex-shrink: 0;
        }

        .ppdb-form {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 40px 35px;
            box-shadow: var(--shadow-xl);
            transform: translateY(-20px);
            position: relative;
            z-index: 2;
        }

        .form-control,
        .form-select {
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            transition: var(--transition);
            font-size: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.15);
        }

        /* Gallery Section */
        .gallery-item {
            position: relative;
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 300px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 102, 204, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-text {
            text-align: center;
            color: white;
            padding: 20px;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-text {
            transform: translateY(0);
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
            .hero-title {
                font-size: 3.2rem;
            }

            .section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .section-padding {
                padding: 80px 0;
            }

            .hero-section {
                padding: 150px 0 80px;
                text-align: center;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-carousel {
                margin-top: 50px;
            }

            .hero-carousel .carousel-item img {
                height: 400px;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .ppdb-form {
                transform: none;
                margin-top: 40px;
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
            .hero-title {
                font-size: 2.3rem;
            }

            .hero-subtitle {
                font-size: 1.3rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1.1rem;
            }

            .btn {
                padding: 12px 25px;
                font-size: 0.95rem;
            }

            .hero-carousel .carousel-item img {
                height: 350px;
            }

            .stat-card,
            .jurusan-card,
            .facility-card {
                margin-bottom: 25px;
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
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .hero-buttons .btn {
                width: 100%;
            }

            .hero-carousel .carousel-item img {
                height: 300px;
            }

            .ppdb-form {
                padding: 30px 20px;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
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
                <a class="navbar-brand" href="#beranda">
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
                            <a class="nav-link active" href="#beranda">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profil') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jurusan">Jurusan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fasilitas">Fasilitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kegiatan">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ppdb">PPDB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#galeri">Galeri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="beranda" class="hero-section">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInUp">SMK Muhammadiyah 1 Berbek Nganjuk
                        </h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">Mewujudkan
                            Generasi Unggul, Berkarakter, dan Berdaya Saing Global</p>
                        <p class="hero-description animate__animated animate__fadeInUp animate__delay-2s">Sekolah
                            Menengah Kejuruan yang berkomitmen untuk menghasilkan lulusan yang kompeten, berakhlak
                            mulia, dan siap menghadapi tantangan dunia kerja dengan kurikulum berbasis industri.</p>
                        <div class="hero-buttons mt-4 animate__animated animate__fadeInUp animate__delay-3s">
                            <a href="#ppdb" class="btn btn-light btn-lg">Daftar Sekarang</a>
                            <a href="{{ route('profil') }}" class="btn btn-outline-light btn-lg">Tentang Kami</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-carousel animate__animated animate__fadeIn animate__delay-1s">
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"
                                    aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('images/hero/hero1.jpg') }}" class="d-block w-100"
                                        alt="Gedung Sekolah">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/hero/hero2.jpg') }}" class="d-block w-100"
                                        alt="Kegiatan Belajar">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/hero/hero3.jpg') }}" class="d-block w-100"
                                        alt="Laboratorium Komputer">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/hero/hero4.jpg') }}" class="d-block w-100"
                                        alt="Bengkel Otomotif">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-number">850+</div>
                        <div class="stat-text">Siswa Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-number">45+</div>
                        <div class="stat-text">Guru Berpengalaman</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-number">120+</div>
                        <div class="stat-text">Prestasi</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number">3</div>
                        <div class="stat-text">Program Jurusan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="jurusan" class="section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="section-title center">Program Keahlian</h2>
                    <p class="section-subtitle mx-auto">Pilih jurusan yang sesuai dengan minat dan bakat Anda untuk
                        masa depan yang cerah</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card jurusan-card">
                        <div class="card-body text-center">
                            <div class="jurusan-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <h4 class="card-title">AKL</h4>
                            <h5 class="card-subtitle mb-3">Akuntansi dan Keuangan Lembaga</h5>
                            <p class="card-text">Mempelajari pengelolaan keuangan, akuntansi, dan administrasi
                                perpajakan untuk berbagai jenis lembaga.</p>
                            <div class="mt-3">
                                <span class="jurusan-badge">Prospek Kerja Luas</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card jurusan-card">
                        <div class="card-body text-center">
                            <div class="jurusan-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 class="card-title">TKJ</h4>
                            <h5 class="card-subtitle mb-3">Teknik Komputer dan Jaringan</h5>
                            <p class="card-text">Mempelajari perakitan, perbaikan komputer, instalasi jaringan, dan
                                administrasi sistem jaringan.</p>
                            <div class="mt-3">
                                <span class="jurusan-badge">Bidang IT Berkembang</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card jurusan-card">
                        <div class="card-body text-center">
                            <div class="jurusan-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <h4 class="card-title">TKRO</h4>
                            <h5 class="card-subtitle mb-3">Teknik Kendaraan Ringan Otomotif</h5>
                            <p class="card-text">Mempelajari perawatan, perbaikan kendaraan ringan, dan sistem
                                kelistrikan otomotif.</p>
                            <div class="mt-3">
                                <span class="jurusan-badge">Industri Otomotif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card jurusan-card">
                        <div class="card-body text-center">
                            <div class="jurusan-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h4 class="card-title">TBSM</h4>
                            <h5 class="card-subtitle mb-3">Teknik Bisnis Sepeda Motor</h5>
                            <p class="card-text">Mempelajari teknik perbaikan, perawatan, dan bisnis sepeda motor serta
                                sistem kelistrikannya.</p>
                            <div class="mt-3">
                                <span class="jurusan-badge">Bidang Otomotif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="section-padding bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="section-title center">Fasilitas Sekolah</h2>
                    <p class="section-subtitle mx-auto">Fasilitas lengkap dan modern untuk mendukung proses belajar
                        mengajar yang optimal</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card facility-card">
                        <img src="{{ asset('images/fasilitas/kelas.jpg') }}" class="card-img-top" alt="Ruang Kelas">
                        <div class="facility-overlay">
                            <h5 class="card-title text-white">Ruang Kelas Nyaman</h5>
                            <p class="card-text">Ruang kelas yang dilengkapi dengan AC, LCD projector, dan fasilitas
                                pendukung pembelajaran lainnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card facility-card">
                        <img src="{{ asset('images/fasilitas/lab-kom.jpg') }}"
                            class="card-img-top" alt="Laboratorium Komputer">
                        <div class="facility-overlay">
                            <h5 class="card-title text-white">Laboratorium Komputer</h5>
                            <p class="card-text">Laboratorium komputer dengan spesifikasi tinggi untuk praktik
                                pemrograman dan jaringan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card facility-card">
                        <img src="{{ asset('images/fasilitas/bengkel.jpg') }}"
                            class="card-img-top" alt="Bengkel Otomotif">
                        <div class="facility-overlay">
                            <h5 class="card-title text-white">Bengkel Otomotif</h5>
                            <p class="card-text">Bengkel lengkap dengan peralatan modern untuk praktik teknik kendaraan
                                ringan dan sepeda motor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ppdb" class="ppdb-section section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="text-white fw-bold">Penerimaan Peserta Didik Baru</h2>
                    <p class="section-subtitle text-white mb-4">Tahun Ajaran 2026/2027 - Bergabunglah dengan Keluarga
                        Besar SMK Muhammadiyah 1 Berbek</p>
                    <div class="ppdb-info">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="ppdb-info-card">
                                    <div class="d-flex align-items-center">
                                        <div class="ppdb-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <h5 class="text-white">Jadwal Pendaftaran</h5>
                                            <p class="text-white mb-0">1 Mei - 30 Juni 2026</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="ppdb-info-card">
                                    <div class="d-flex align-items-center">
                                        <div class="ppdb-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div>
                                            <h5 class="text-white">Syarat Pendaftaran</h5>
                                            <p class="text-white mb-0">FC Ijazah, FC SKHUN, FC Akte Kelahiran</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="ppdb-info-card">
                                    <div class="d-flex align-items-center">
                                        <div class="ppdb-icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div>
                                            <h5 class="text-white">Biaya Pendaftaran</h5>
                                            <p class="text-white mb-0">Rp 250.000 (Dapat dicicil)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="ppdb-info-card">
                                    <div class="d-flex align-items-center">
                                        <div class="ppdb-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div>
                                            <h5 class="text-white">Kuota Penerimaan</h5>
                                            <p class="text-white mb-0">320 Siswa (8 Rombel)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ppdb-form">
                        <h4 class="text-center mb-4 text-primary">Formulir Minat</h4>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" placeholder="Nomor Telepon">
                            </div>
                            <div class="mb-3">
                                <select class="form-select">
                                    <option selected>Pilih Jurusan</option>
                                    <option value="AKL">Akuntansi dan Keuangan Lembaga (AKL)</option>
                                    <option value="TKJ">Teknik Komputer dan Jaringan (TKJ)</option>
                                    <option value="TKRO">Teknik Kendaraan Ringan Otomotif (TKRO)</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Minat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="section-title center">Galeri Kegiatan</h2>
                    <p class="section-subtitle mx-auto">Momen berharga dalam kegiatan belajar mengajar di SMK
                        Muhammadiyah 1 Berbek</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset('images/gallery/g1.jpg') }}"
                            alt="Praktikum Lab">
                        <div class="gallery-overlay">
                            <div class="gallery-text">
                                <h5>Praktikum Lab Komputer</h5>
                                <p>Kegiatan praktikum jaringan komputer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset('images/gallery/g2.jpg') }}">
                        <div class="gallery-overlay">
                            <div class="gallery-text">
                                <h5>Kegiatan Ekstrakurikuler</h5>
                                <p>Latihan pramuka di lapangan sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset('images/gallery/g3.jpg') }}"
                            alt="Upacara Bendera">
                        <div class="gallery-overlay">
                            <div class="gallery-text">
                                <h5>Upacara Bendera</h5>
                                <p>Kegiatan upacara bendera setiap hari Senin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary btn-lg">Lihat Galeri Lengkap</a>
            </div>
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
                        <li><a href="#beranda"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                        <li><a href="#profil"><i class="fas fa-chevron-right"></i> Profil Sekolah</a></li>
                        <li><a href="#jurusan"><i class="fas fa-chevron-right"></i> Program Jurusan</a></li>
                        <li><a href="#fasilitas"><i class="fas fa-chevron-right"></i> Fasilitas</a></li>
                        <li><a href="#ppdb"><i class="fas fa-chevron-right"></i> PPDB</a></li>
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

        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.stat-card, .jurusan-card, .facility-card, .gallery-item');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        document.querySelectorAll('.stat-card, .jurusan-card, .facility-card, .gallery-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>

</html>
