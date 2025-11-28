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
            --dark: #1a1a2e;
            --darker: #0d0d1a;
            --light: #f8f9fa;
            --lighter: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary), var(--secondary));
            --gradient-dark: linear-gradient(135deg, var(--primary-dark), #0097e6);
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
            background: var(--primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
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
            cursor: pointer;
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
            background: var(--gradient);
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

        .pengumuman-modal .modal-content {
            border-radius: var(--border-radius-lg);
            border: none;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            background: var(--lighter);
            position: relative;
        }

        .pengumuman-modal .modal-header {
            border-bottom: none;
            padding: 25px 30px 15px;
            position: relative;
            background: var(--gradient);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pengumuman-modal .modal-title-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            width: 100%;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pengumuman-modal .modal-title-wrapper {
            flex: 1;
            min-width: 250px;
        }

        .pengumuman-modal .modal-title {
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.3;
            margin: 0 0 10px 0;
            color: #ffff;
            position: relative;
        }

        .pengumuman-modal .modal-subtitle {
            color: #f5f5f5;
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pengumuman-modal .modal-subtitle i {
            color: #ffff;
        }

        .pengumuman-modal .btn-close {
            position: absolute;
            top: 25px;
            right: 25px;
            background: #ffff;
            opacity: 1;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            padding: 0;
            border: none;
            color: var(--primary);
            font-size: 1.2rem;
            z-index: 10;
        }

        .pengumuman-modal .btn-close:hover {
            transform: rotate(90deg);
            opacity: 1;
        }

        .pengumuman-modal .modal-body {
            padding: 0 30px 25px;
        }

        .pengumuman-modal .modal-image-container {
            position: relative;
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(23, 162, 184, 0.1);
        }

        .pengumuman-modal .modal-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pengumuman-modal .modal-image:hover {
            transform: scale(1.02);
        }

        .pengumuman-modal .modal-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--gradient);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            box-shadow: var(--shadow);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pengumuman-modal .detail-section {
            margin-bottom: 25px;
        }

        .pengumuman-modal .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            padding-bottom: 8px;
        }

        .pengumuman-modal .section-title i {
            background: var(--primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .pengumuman-modal .detail-content {
            background: rgba(23, 162, 184, 0.03);
            border-radius: var(--border-radius);
            padding: 20px;
            border-left: 4px solid var(--primary);
            line-height: 1.7;
            color: #555;
            font-size: 1rem;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .pengumuman-modal .detail-content::-webkit-scrollbar {
            width: 6px;
        }

        .pengumuman-modal .detail-content::-webkit-scrollbar-track {
            background: rgba(23, 162, 184, 0.05);
            border-radius: 10px;
        }

        .pengumuman-modal .detail-content::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        .pengumuman-modal .detail-content::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        .pengumuman-modal .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .pengumuman-modal .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(23, 162, 184, 0.1);
        }

        .pengumuman-modal .info-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(23, 162, 184, 0.3);
        }

        .pengumuman-modal .info-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: white;
            border-radius: 12px;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(23, 162, 184, 0.3);
        }

        .pengumuman-modal .info-content h4 {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pengumuman-modal .info-content p {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .pengumuman-modal .modal-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(23, 162, 184, 0.03), rgba(106, 212, 232, 0.03));
            flex-wrap: wrap;
            gap: 15px;
        }

        .pengumuman-modal .status-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow);
        }

        .pengumuman-modal .status-indicator.active {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .pengumuman-modal .status-indicator.inactive {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        .pengumuman-modal .btn-modal {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .pengumuman-modal .btn-modal::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .pengumuman-modal .btn-modal:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .pengumuman-modal .btn-modal:hover::before {
            left: 100%;
        }

        /* NEW: Improved Responsive Modal Styles */
        @media (max-width: 1199.98px) {
            .pengumuman-modal .modal-title {
                font-size: 1.6rem;
            }
            
            .pengumuman-modal .modal-image {
                height: 300px;
            }
        }

        @media (max-width: 991.98px) {
            .pengumuman-modal .modal-header {
                padding: 20px 25px 15px;
            }
            
            .pengumuman-modal .modal-body {
                padding: 0 25px 20px;
            }
            
            .pengumuman-modal .modal-title {
                font-size: 1.5rem;
            }
            
            .pengumuman-modal .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .pengumuman-modal .modal-image {
                height: 280px;
            }
        }

        @media (max-width: 767.98px) {
            .pengumuman-modal .modal-dialog {
                margin: 15px;
                max-width: calc(100% - 30px);
            }
            
            .pengumuman-modal .modal-header {
                padding: 20px 20px 15px;
            }
            
            .pengumuman-modal .modal-body {
                padding: 0 20px 20px;
            }
            
            .pengumuman-modal .modal-title {
                font-size: 1.4rem;
            }
            
            .pengumuman-modal .btn-close {
                top: 15px;
                right: 15px;
                width: 35px;
                height: 35px;
            }
            
            .pengumuman-modal .modal-image {
                height: 220px;
            }
            
            .pengumuman-modal .modal-footer {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .pengumuman-modal .status-indicator {
                justify-content: center;
            }
            
            .pengumuman-modal .btn-modal {
                width: 100%;
                justify-content: center;
            }
            
            .pengumuman-modal .detail-content {
                max-height: 250px;
                padding: 15px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 575.98px) {
            .pengumuman-modal .modal-dialog {
                margin: 10px;
                max-width: calc(100% - 20px);
            }
            
            .pengumuman-modal .modal-header {
                padding: 15px 15px 10px;
            }
            
            .pengumuman-modal .modal-body {
                padding: 0 15px 15px;
            }
            
            .pengumuman-modal .modal-title {
                font-size: 1.3rem;
            }
            
            .pengumuman-modal .btn-close {
                top: 12px;
                right: 12px;
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
            
            .pengumuman-modal .modal-image {
                height: 180px;
            }
            
            .pengumuman-modal .info-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
                padding: 12px;
            }
            
            .pengumuman-modal .modal-footer {
                padding: 15px;
            }
            
            .pengumuman-modal .detail-content {
                max-height: 200px;
                padding: 12px;
                font-size: 0.9rem;
            }
            
            .pengumuman-modal .section-title {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 400px) {
            .pengumuman-modal .modal-title {
                font-size: 1.2rem;
            }
            
            .pengumuman-modal .modal-image {
                height: 160px;
            }
            
            .pengumuman-modal .modal-subtitle {
                font-size: 0.85rem;
            }
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
                            <div class="pengumuman-card animate__animated animate__fadeInUp"
                                 data-pengumuman-id="{{ $item->id }}"
                                 data-pengumuman-nama="{{ $item->nama_pengumuman }}"
                                 data-pengumuman-deskripsi="{{ $item->deskripsi_pengumuman }}"
                                 data-pengumuman-foto="{{ $item->foto_pengumuman_url }}"
                                 data-pengumuman-tanggal="{{ $item->created_at->format('d M Y') }}"
                                 data-pengumuman-status="{{ $item->status ? 'active' : 'inactive' }}"
                                 data-pengumuman-urutan="{{ $item->urutan }}">
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

    <div class="modal fade pengumuman-modal" id="pengumumanModal" tabindex="-1" aria-labelledby="pengumumanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title-container">
                        <div class="modal-title-wrapper">
                            <h2 class="modal-title" id="pengumumanModalLabel">Detail Pengumuman</h2>
                            <p class="modal-subtitle">
                                <i class="fas fa-info-circle"></i>
                                <span id="modalTanggal">-</span>
                            </p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-image-container mt-3">
                        <img id="modalImage" src="" alt="Foto Pengumuman" class="modal-image">
                        <div class="modal-badge">
                            <i class="fas fa-bullhorn me-1"></i> Pengumuman
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-file-alt"></i>
                            Deskripsi Pengumuman
                        </h3>
                        <div class="detail-content" id="modalDeskripsi">
                            -
                        </div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="info-content">
                                <h4>Tanggal Dibuat</h4>
                                <p id="modalTanggalDibuat">-</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="info-content">
                                <h4>Prioritas</h4>
                                <p id="modalUrutan">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="status-indicator" id="modalStatus">
                        <i class="fas fa-circle"></i>
                        <span>Status: -</span>
                    </div>
                    <button type="button" class="btn btn-modal" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup Pengumuman
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        // NEW: Enhanced Modal functionality for Pengumuman
        document.querySelectorAll('.pengumuman-card').forEach(card => {
            card.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('pengumumanModal'));
                
                // Get data from card
                const namaPengumuman = this.getAttribute('data-pengumuman-nama');
                const deskripsi = this.getAttribute('data-pengumuman-deskripsi');
                const foto = this.getAttribute('data-pengumuman-foto');
                const tanggal = this.getAttribute('data-pengumuman-tanggal');
                const status = this.getAttribute('data-pengumuman-status');
                const urutan = this.getAttribute('data-pengumuman-urutan');
                
                // Set modal content
                document.getElementById('pengumumanModalLabel').textContent = namaPengumuman;
                document.getElementById('modalTanggal').textContent = `Dipublikasikan: ${tanggal}`;
                document.getElementById('modalTanggalDibuat').textContent = tanggal;
                document.getElementById('modalImage').src = foto;
                document.getElementById('modalImage').alt = namaPengumuman;
                document.getElementById('modalDeskripsi').textContent = deskripsi;
                document.getElementById('modalUrutan').textContent = `Prioritas ${urutan}`;
                
                // Set status
                const statusElement = document.getElementById('modalStatus');
                statusElement.className = `status-indicator ${status}`;
                statusElement.innerHTML = `<i class="fas fa-circle"></i><span>Status: ${status === 'active' ? 'Aktif' : 'Tidak Aktif'}</span>`;
                
                // Show modal
                modal.show();
                
                // Add animation to modal elements
                setTimeout(() => {
                    const modalItems = document.querySelectorAll('.pengumuman-modal .info-item');
                    modalItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 50);
                        }, index * 150);
                    });
                }, 300);
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