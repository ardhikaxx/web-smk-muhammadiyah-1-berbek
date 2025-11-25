<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-white.png') }}" alt="SMK Muhammadiyah 1 Berbek">
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-image"></i>
                <span>Manajemen Banner</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-building"></i>
                <span>Manajemen Fasilitas</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-trophy"></i>
                <span>Manajemen Prestasi</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-graduation-cap"></i>
                <span>Manajemen Jurusan</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Tenaga Pendidik</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-images"></i>
                <span>Manajemen Gallery</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>
</aside>

<div class="mobile-overlay"></div>