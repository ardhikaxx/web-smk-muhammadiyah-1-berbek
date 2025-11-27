<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SMK Muhammadiyah 1 Berbek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-single.png') }}" type="image/x-icon">

    @stack('styles')
</head>

<body>
    <div class="admin-wrapper">
        @include('partials.sidebar')
        <div class="main-content" id="mainContent">
            @include('partials.header')
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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

            // Dropdown functionality for sidebar
            const dropdownToggles = document.querySelectorAll('.sidebar-link.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentItem = this.parentElement;
                    const dropdown = this.nextElementSibling;
                    const arrow = this.querySelector('.dropdown-arrow');

                    // Close other dropdowns
                    document.querySelectorAll('.sidebar-item.has-dropdown').forEach(item => {
                        if (item !== parentItem) {
                            item.classList.remove('active');
                            item.querySelector('.sidebar-dropdown').classList.remove(
                            'show');
                            const otherArrow = item.querySelector('.dropdown-arrow');
                            if (otherArrow) {
                                otherArrow.style.transform = 'rotate(0deg)';
                            }
                        }
                    });

                    // Toggle current dropdown
                    parentItem.classList.toggle('active');
                    dropdown.classList.toggle('show');

                    if (arrow) {
                        arrow.style.transform = parentItem.classList.contains('active') ?
                            'rotate(180deg)' :
                            'rotate(0deg)';
                    }
                });
            });

            document.querySelectorAll('.sidebar-dropdown .sidebar-link.active').forEach(activeLink => {
                const dropdown = activeLink.closest('.sidebar-dropdown');
                const parentItem = dropdown?.parentElement;

                if (dropdown && parentItem) {
                    parentItem.classList.add('active');
                    dropdown.classList.add('show');
                    const arrow = parentItem.querySelector('.dropdown-arrow');
                    if (arrow) {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                }
            });

            // Close dropdowns when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 991.98) {
                    if (!e.target.closest('.sidebar')) {
                        document.querySelectorAll('.sidebar-item.has-dropdown').forEach(item => {
                            item.classList.remove('active');
                            item.querySelector('.sidebar-dropdown').classList.remove('show');
                            const arrow = item.querySelector('.dropdown-arrow');
                            if (arrow) {
                                arrow.style.transform = 'rotate(0deg)';
                            }
                        });
                    }
                }
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
        });

        loadAdminData();

        function loadAdminData() {
            fetch('{{ route('admin.current') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const admin = data.admin;
                        document.getElementById('adminName').textContent = admin.nama_lengkap;
                        document.getElementById('adminNameShort').textContent = admin.nama_lengkap;
                        document.getElementById('dropdownAdminName').textContent = admin.nama_lengkap;

                        const profileBtn = document.querySelector('.profile-btn');
                        if (admin.foto_profil) {
                            const existingAvatar = profileBtn.querySelector('.profile-avatar');
                            if (existingAvatar) {
                                existingAvatar.src = admin.foto_profil;
                            } else {
                                const avatar = document.createElement('img');
                                avatar.src = admin.foto_profil;
                                avatar.alt = 'Profile';
                                avatar.className = 'profile-avatar';
                                profileBtn.insertBefore(avatar, profileBtn.firstChild);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error loading admin data:', error);
                });
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                colorIcon: '#dd3333',
                showCancelButton: true,
                confirmButtonColor: '#dd3333',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    icon: 'text-danger border-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('auth.logout') }}';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('logout-link')) {
                e.preventDefault();
                confirmLogout();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
