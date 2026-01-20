<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SMK Muhammadiyah 1 Berbek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
            transition: filter 0.3s ease;
        }

        body.true-tone-active {
            filter: sepia(0.3) hue-rotate(-15deg);
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

        .true-tone-btn {
            background: transparent;
            border: none;
            color: var(--dark);
            font-size: 1.2rem;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            margin-left: 10px;
            position: relative;
        }

        .true-tone-btn:hover {
            background: rgba(0, 102, 204, 0.05);
            color: var(--primary);
        }

        .true-tone-btn.active {
            color: var(--primary);
            background: rgba(0, 102, 204, 0.1);
        }

        .true-tone-btn .tooltip-text {
            visibility: hidden;
            width: auto;
            background-color: var(--dark);
            color: white;
            text-align: center;
            border-radius: 8px;
            padding: 5px 10px;
            position: absolute;
            z-index: 1;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.8rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .true-tone-btn .tooltip-text::after {
            content: "";
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent var(--dark) transparent;
        }

        .true-tone-btn:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 991.98px) {
            .true-tone-btn {
                margin-left: 0;
                margin-top: 10px;
                width: 40px;
                height: 40px;
            }
            
            .navbar-nav {
                align-items: center;
            }
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
            padding: 20px 0;
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

        /* Profil Section */
        .profil-card {
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

        .profil-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
            z-index: 2;
        }

        .profil-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-lg);
        }

        .profil-icon {
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

        .profil-card:hover .profil-icon {
            transform: rotate(0) scale(1.1);
        }

        .profil-card .card-body {
            padding: 30px 25px;
        }

        .profil-card .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .profil-card .card-text {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .struktur-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .struktur-img {
            max-width: 100%;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .teacher-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            background: white;
            position: relative;
        }

        .teacher-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .teacher-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
            transition: var(--transition);
        }

        .teacher-card:hover .teacher-img {
            transform: scale(1.05);
        }

        .teacher-card .card-body {
            padding: 25px;
        }

        .teacher-card .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 5px;
        }

        .teacher-card .card-subtitle {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .teacher-card .card-text {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .teacher-contact {
            display: flex;
            gap: 10px;
        }

        .teacher-contact a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--light);
            border-radius: 10px;
            color: var(--primary);
            transition: var(--transition);
            text-decoration: none;
        }

        .teacher-contact a:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }

        /* Tenaga Pendidik Item yang tersembunyi */
        .teacher-item.hidden {
            display: none;
        }

        .teacher-item.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Visi Misi Section */
        .visi-misi-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 40px 35px;
            margin-bottom: 30px;
            transition: var(--transition);
        }

        .visi-misi-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .visi-misi-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            color: white;
            font-size: 1.8rem;
        }

        .indikator-list {
            list-style-type: none;
            padding-left: 0;
        }

        .indikator-list li {
            margin-bottom: 12px;
            padding-left: 25px;
            position: relative;
        }

        .indikator-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
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

            .stat-card,
            .profil-card,
            .teacher-card {
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
                            <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profil') }}">Profil Sekolah</a>
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
                        <li class="nav-item d-flex align-items-center">
                            <button class="true-tone-btn" id="trueToneToggle" aria-label="Aktifkan True Tone">
                                <i class="fas fa-adjust"></i>
                                <span class="tooltip-text">Aktifkan True Tone</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="sejarah" class="hero-section">
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
                        <h1 class="hero-title animate__animated animate__fadeInUp">Profil SMK Muhammadiyah 1 Berbek
                            Nganjuk</h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">Menelusuri Jejak
                            Perjalanan dan Identitas Sekolah</p>
                        <p class="hero-description animate__animated animate__fadeInUp animate__delay-2s">SMK
                            Muhammadiyah 1 Berbek telah menjadi bagian penting dalam dunia pendidikan di Kabupaten
                            Nganjuk, dengan komitmen untuk menghasilkan lulusan yang kompeten, berakhlak mulia, dan siap
                            menghadapi tantangan dunia kerja.</p>
                        <div class="hero-buttons mt-4 animate__animated animate__fadeInUp animate__delay-3s">
                            <a href="#visi-misi" class="btn btn-light btn-lg">Visi & Misi</a>
                            <a href="#struktur" class="btn btn-outline-light btn-lg">Struktur Organisasi</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-carousel animate__animated animate__fadeIn animate__delay-1s">
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            @if ($banners->count() > 0)
                                <div class="carousel-indicators">
                                    @foreach ($banners as $index => $banner)
                                        <button type="button" data-bs-target="#heroCarousel"
                                            data-bs-slide-to="{{ $index }}"
                                            class="{{ $index == 0 ? 'active' : '' }}"
                                            aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner">
                                    @foreach ($banners as $index => $banner)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ $banner->gambar_url }}" class="d-block w-100"
                                                alt="{{ $banner->judul ?? 'Banner' }}">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('images/default-img.png') }}" class="d-block w-100"
                                            alt="default">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('images/default-img.png') }}" class="d-block w-100"
                                            alt="default">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('images/default-img.png') }}" class="d-block w-100"
                                            alt="default">
                                    </div>
                                </div>
                            @endif

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
            <div class="row mt-3">
                <div class="col-md-3 col-12 mb-4 lg:mb-0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number">{{ $jumlahFasilitas }}+</div>
                        <div class="stat-text">Fasilitas</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4 lg:mb-0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-number">{{ $jumlahPengajar }}+</div>
                        <div class="stat-text">Guru Berpengalaman</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4 lg:mb-0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-number">{{ $jumlahPrestasi }}+</div>
                        <div class="stat-text">Prestasi</div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-4 lg:mb-0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-number">{{ $jumlahJurusan }}</div>
                        <div class="stat-text">Program Jurusan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sejarah-detail" class="section-padding">
        <div class="container">
            <div class="row mb-2">
                <div class="col text-center">
                    <h2 class="section-title center">Sejarah Singkat</h2>
                    <p class="section-subtitle mx-auto">Perjalanan panjang SMK Muhammadiyah 1 Berbek dalam membangun
                        generasi unggul</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="profil-card">
                        <div class="card-body text-center">
                            <div class="profil-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h4 class="card-title">Awal Berdiri</h4>
                            <p class="card-text">SMK Muhammadiyah 1 Berbek didirikan pada tahun 2003 dengan visi untuk
                                memberikan pendidikan kejuruan yang berkualitas bagi masyarakat Kabupaten Nganjuk dan
                                sekitarnya. Pada awal berdirinya, sekolah ini hanya memiliki dua program keahlian dengan
                                jumlah siswa yang terbatas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="profil-card">
                        <div class="card-body text-center">
                            <div class="profil-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4 class="card-title">Perkembangan</h4>
                            <p class="card-text">Seiring berjalannya waktu, SMK Muhammadiyah 1 Berbek terus berkembang
                                dengan menambah program keahlian dan meningkatkan kualitas pendidikan. Hingga saat ini,
                                sekolah telah memiliki empat program keahlian yang relevan dengan kebutuhan industri dan
                                dunia kerja.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="profil-card">
                        <div class="card-body text-center">
                            <div class="profil-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <h4 class="card-title">Prestasi</h4>
                            <p class="card-text">Selama perjalanannya, SMK Muhammadiyah 1 Berbek telah meraih berbagai
                                prestasi baik di tingkat regional maupun nasional. Prestasi tersebut mencakup bidang
                                akademik, non-akademik, dan kompetensi keahlian yang membuktikan kualitas pendidikan
                                yang diberikan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="profil-card">
                        <div class="card-body text-center">
                            <div class="profil-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="card-title">Masa Depan</h4>
                            <p class="card-text">Dengan komitmen untuk terus berinovasi dan meningkatkan kualitas, SMK
                                Muhammadiyah 1 Berbek bertekad untuk menjadi pusat pendidikan kejuruan unggulan yang
                                menghasilkan lulusan berkompeten, berkarakter, dan siap bersaing di era globalisasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="visi-misi" class="section-padding bg-light">
        <div class="container">
            <div class="row mb-2">
                <div class="col text-center">
                    <h2 class="section-title center">Visi & Misi</h2>
                    <p class="section-subtitle mx-auto">Pedoman dan arah perjalanan SMK Muhammadiyah 1 Berbek</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="visi-misi-card">
                        <div class="visi-misi-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="mb-4">Visi Sekolah</h3>
                        <p class="mb-4">"Terwujudnya sekolah yang islami / religius, unggul (kreatif, inovatif, kerja
                            keras, komitmen) dan kompetitif (berani mengambil resiko, motivasi kuat untuk sukses)
                            sebagai pusat pendidikan dan pelatihan untuk menghasilkan tenaga kerja (kerja keras, ulet)
                            tingkat menengah maupun pekerja mandiri (mandiri) dengan integritas IMTAK dan IPTEKS
                            (religius dan kreatif)."</p>

                        <h4 class="mb-3">Indikator Visi</h4>
                        <ul class="indikator-list">
                            <li>Sekolah menanamkan perilaku kehidupan yang Islami (religius)</li>
                            <li>Peserta didik unggul dalam bidang akademik dan non akademik (kreatif, inovatif, kerja
                                keras, pantang menyerah, disiplin, tanggung jawab)</li>
                            <li>Peserta didik unggul dalam bidang kompetensi keahlian (kreatif, inovatif, kerja keras,
                                pantang menyerah, disiplin, tanggung jawab)</li>
                            <li>Guru unggul dalam inovasi pembelajaran (kreatif inovatif, kerja keras, pantang menyerah,
                                disiplin, tanggung jawab)</li>
                            <li>Sekolah mampu menghasilkan output yang mampu bersaing dengan sekolah lainnya (berani
                                mengambil resiko, motivasi kuat untuk sukses)</li>
                            <li>Sekolah mampu menghasilkan output sebagai tenaga kerja tingkat menengah (kerja keras,
                                ulet)</li>
                            <li>Sekolah mampu menghasilkan output sebagai pekerja mandiri (mandiri)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="visi-misi-card">
                        <div class="visi-misi-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="mb-4">Misi Sekolah</h3>
                        <ul class="indikator-list">
                            <li>Membina pembiasaan implementasi ajaran Islam dalam kehidupan sehari-hari.</li>
                            <li>Mewujudkan dokumentasi kurikulum yang lengkap dan mutakir.</li>
                            <li>Melaksanakan program pembelajaran dengan budaya mengajar sampai bisa, melatih sampai
                                terampil, dan mendidik sampai baik.</li>
                            <li>Melaksanakan pembelajaran aktif, inovatif, kreatif, efektif, menyenangkan, gembira, dan
                                berbobot.</li>
                            <li>Melaksanakan pendampingan kepada lulusan sampai bekerja atau kuliah.</li>
                        </ul>

                        <h4 class="mb-3 mt-4">Tujuan Sekolah</h4>
                        <ul class="indikator-list">
                            <li>Menghasilkan tamatan yang kuat imannya, kompeten di bidangnya, siap pakai / berkembang,
                                mampu berwirausaha, taat beribadah, dan berakhlaq mulia.</li>
                            <li>Menghasilkan tamatan yang mampu berperan serta dalam kegiatan pembangunan sesuai dengan
                                bidangnya, menyesuaikan diri dengan lingkungannya, dan selalu mengembangkan potensi
                                dirinya sesuai tuntutan pasar kerja dan tantangan zamannya.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="struktur" class="section-padding">
        <div class="container">
            <div class="row mb-2">
                <div class="col text-center">
                    <h2 class="section-title center">Struktur Organisasi</h2>
                    <p class="section-subtitle mx-auto">Tata kelola dan kepemimpinan SMK Muhammadiyah 1 Berbek</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="struktur-container">
                        <h3 class="mb-4">Struktur Organisasi SMK Muhammadiyah 1 Berbek</h3>

                        @if ($struktur)
                            <img src="{{ $struktur->gambar_struktur_url }}" alt="Struktur Organisasi"
                                class="struktur-img img-fluid">
                            <p class="mt-4">Struktur organisasi yang jelas dan terarah untuk mendukung efektivitas
                                proses
                                pendidikan dan administrasi sekolah.</p>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Gambar struktur organisasi sedang dalam proses pembaruan.
                            </div>
                            <div class="text-center">
                                <i class="fas fa-sitemap fa-4x text-muted mb-3"></i>
                                <p class="text-muted">Struktur organisasi akan segera tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tenaga-pendidik" class="section-padding bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="section-title center">Tenaga Pendidik</h2>
                    <p class="section-subtitle mx-auto">Guru dan staf pengajar yang berkompeten di bidangnya</p>
                </div>
            </div>
            <div class="row" id="teachers-container">
                @forelse($pengajars as $index => $pengajar)
                    <div class="col-md-6 col-lg-4 mb-4 teacher-item {{ $index >= 6 ? 'hidden' : '' }}">
                        <div class="teacher-card">
                            <img src="{{ $pengajar->foto_pengajar_url }}" class="card-img-top teacher-img"
                                alt="{{ $pengajar->nama_pengajar }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pengajar->nama_pengajar }}</h5>
                                <h6 class="card-subtitle">{{ $pengajar->jabatan }}</h6>
                                @if ($pengajar->nip)
                                    <p class="card-text">{{ $pengajar->nip }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Data tenaga pendidik belum tersedia.</p>
                    </div>
                @endforelse
            </div>
            @if ($pengajars->count() > 6)
                <div class="text-center mt-4">
                    <button id="lihat-pendidik" class="btn btn-primary btn-lg">Lihat Tenaga Pendidik
                        Selengkapnya</button>
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
                        <li><a href="{{ route('pengumuman') }}"><i class="fas fa-chevron-right"></i> Pengumuman</a>
                        </li>
                        <li><a href="{{ route('landing-page') }}#jurusan"><i class="fas fa-chevron-right"></i>Program
                                Jurusan</a></li>
                        <li><a href="{{ route('landing-page') }}#fasilitas"><i
                                    class="fas fa-chevron-right"></i>Fasilitas</a></li>
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

        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.stat-card, .profil-card, .teacher-card, .visi-misi-card');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        document.querySelectorAll('.stat-card, .profil-card, .teacher-card, .visi-misi-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);

        document.getElementById('lihat-pendidik')?.addEventListener('click', function() {
            const hiddenTeachers = document.querySelectorAll('.teacher-item.hidden');
            hiddenTeachers.forEach(item => {
                item.classList.remove('hidden');
                item.classList.add('show');
            });
            this.style.display = 'none';
        });

        // Fungsi True Tone Filter
        const trueToneToggle = document.getElementById('trueToneToggle');
        const tooltipText = trueToneToggle.querySelector('.tooltip-text');
        const isTrueToneActive = localStorage.getItem('trueToneActive') === 'true';
        
        if (isTrueToneActive) {
            document.body.classList.add('true-tone-active');
            trueToneToggle.classList.add('active');
            trueToneToggle.innerHTML = '<i class="fas fa-adjust"></i><span class="tooltip-text">Nonaktifkan True Tone</span>';
        }

        trueToneToggle.addEventListener('click', function() {
            const isActive = document.body.classList.toggle('true-tone-active');
            this.classList.toggle('active');
            
            if (isActive) {
                this.innerHTML = '<i class="fas fa-adjust"></i><span class="tooltip-text">Nonaktifkan True Tone</span>';
                localStorage.setItem('trueToneActive', 'true');
            } else {
                this.innerHTML = '<i class="fas fa-adjust"></i><span class="tooltip-text">Aktifkan True Tone</span>';
                localStorage.setItem('trueToneActive', 'false');
            }
        });

        trueToneToggle.addEventListener('mouseenter', function() {
            const isActive = document.body.classList.contains('true-tone-active');
            tooltipText.textContent = isActive ? 'Nonaktifkan True Tone' : 'Aktifkan True Tone';
        });
    </script>
</body>

</html>
