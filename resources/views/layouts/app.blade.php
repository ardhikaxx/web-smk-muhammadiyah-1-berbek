<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SMK Muhammadiyah 1 Berbek</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header -->
            @include('partials.header')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const mobileOverlay = document.querySelector('.mobile-overlay');

            function isMobile() {
                return window.innerWidth <= 991.98;
            }

            const mobileToggle = document.querySelector('.mobile-toggle');
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    if (isMobile()) {
                        sidebar.classList.toggle('mobile-open');
                        mobileOverlay.classList.toggle('show');
                    }
                });
            }

            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', function() {
                    if (isMobile()) {
                        sidebar.classList.remove('mobile-open');
                        mobileOverlay.classList.remove('show');
                    }
                });
            }

            document.addEventListener('click', function(e) {
                if (isMobile() && sidebar.classList.contains('mobile-open')) {
                    if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                        sidebar.classList.remove('mobile-open');
                        mobileOverlay.classList.remove('show');
                    }
                }
            });

            window.addEventListener('resize', function() {
                if (!isMobile()) {
                    sidebar.classList.remove('mobile-open');
                    mobileOverlay.classList.remove('show');
                }
            });

            const dropdownLinks = document.querySelectorAll('.sidebar-link[data-bs-toggle="dropdown"]');

            dropdownLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('show');

                    const chevron = this.querySelector('.fa-chevron-down');
                    if (chevron) {
                        chevron.classList.toggle('fa-rotate-180');
                    }
                });
            });

            const profileBtn = document.querySelector('.profile-btn');
            const profileMenu = document.querySelector('.profile-menu');

            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', function() {
                    profileMenu.classList.toggle('show');
                });

                document.addEventListener('click', function(e) {
                    if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                        profileMenu.classList.remove('show');
                    }
                });
            }

            // Chart Action Buttons
            const chartActionBtns = document.querySelectorAll('.chart-action-btn');

            chartActionBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    chartActionBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>