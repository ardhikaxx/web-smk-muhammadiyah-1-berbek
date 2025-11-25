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
                    <i class="fas fa-user-circle"></i>
                </button>
                <div class="profile-menu">
                    <a href="#" class="profile-menu-item">
                        <i class="fas fa-user me-2"></i>Profile
                    </a>
                    <a href="#" class="profile-menu-item">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="profile-menu-item">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
