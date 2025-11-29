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

        <!-- Dropdown Manajemen Konten -->
        <li class="sidebar-item has-dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <i class="fas fa-cogs"></i>
                <span>Manajemen Konten</span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>
            <ul class="sidebar-dropdown">
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-banner.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-banner.*') ? 'active' : '' }}">
                        <i class="fas fa-image"></i>
                        <span>Banner</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-struktur.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-struktur.*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap"></i>
                        <span>Struktur Organisasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-pengumuman.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-pengumuman.*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-fasilitas.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-fasilitas.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span>Fasilitas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-prestasi.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-prestasi.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i>
                        <span>Prestasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-jurusan.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-jurusan.*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Jurusan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-gallery.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-gallery.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        <span>Gallery</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Dropdown Manajemen User -->
        <li class="sidebar-item has-dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <i class="fas fa-users"></i>
                <span>Manajemen User</span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>
            <ul class="sidebar-dropdown">
                <li class="sidebar-item">
                    <a href="{{ route('admin.tenaga-pendidik.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.tenaga-pendidik.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Tenaga Pendidik</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.manajemen-admin.index') }}"
                        class="sidebar-link {{ Request::routeIs('admin.manajemen-admin.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        <span>Admin</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('admin.settings') }}"
                class="sidebar-link {{ Request::routeIs('admin.settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        <li class="sidebar-item logout-item">
            <a href="#" class="sidebar-link text-danger" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>

<div class="mobile-overlay"></div>
