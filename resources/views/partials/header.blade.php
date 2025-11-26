<header class="admin-header">
    <div class="header-left">
        <button class="mobile-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="header-title">
            <h1>@yield('title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="header-right">
        <div class="header-actions">
            <div class="profile-dropdown">
                <button class="profile-btn">
                    @if (Auth::guard('admin')->user()->foto_profil)
                        <img src="{{ asset('images/photo/' . Auth::guard('admin')->user()->foto_profil) }}"
                            alt="Profile" class="profile-avatar">
                    @else
                        <i class="fas fa-user-circle"></i>
                    @endif
                    <span class="d-none d-md-inline ms-2 name-header" id="adminNameShort">
                        {{ Auth::guard('admin')->user()->nama_lengkap }}
                    </span>
                </button>
                <div class="profile-menu">
                    <div class="profile-info px-3 py-2 border-bottom">
                        <div class="fw-bold text-primary" id="dropdownAdminName">
                            {{ Auth::guard('admin')->user()->nama_lengkap }}
                        </div>
                        <small class="text-muted">{{ Auth::guard('admin')->user()->email }}</small>
                    </div>
                    <a href="{{ route('admin.settings') }}" class="profile-menu-item">
                        <i class="fas fa-user-cog me-2"></i>Profile Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="profile-menu-item text-danger" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
