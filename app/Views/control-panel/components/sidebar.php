<aside class="menu-sidebar" id="main-sidebar">

    <div class="logo">
        <a class="logo-link" href="<?= base_url('dashboard') ?>">
            <span class="logo-mark">S</span>
            <span class="logo-text">SIG Sekolah</span>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">

        <nav class="navbar-sidebar">

            <ul class="list-unstyled navbar__list">

                <li class="sidebar-title">
                    DASHBOARD
                </li>

                <li class="<?= uri_string() === 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>

                <li class="sidebar-title">
                    MASTER DATA
                </li>

                <li class="<?= strpos(uri_string(), 'admin/sekolah') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/sekolah') ?>">
                        <i class="fas fa-school"></i>
                        Data Sekolah
                    </a>
                </li>

                <li class="<?= strpos(uri_string(), 'admin/geojson/list') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/geojson/list') ?>">
                        <i class="fas fa-draw-polygon"></i>
                        Data GeoJson
                    </a>
                </li>

                <li class="sidebar-title">
                    VISUALISASI
                </li>

                <li class="<?= uri_string() === 'admin/maps/index' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/maps/index') ?>">
                        <i class="fas fa-map-location-dot"></i>
                        Maps Sekolah & GeoJson
                    </a>
                </li>

                <?php if (session()->get('user_role') === 'super_admin'): ?>

                    <li class="sidebar-title">
                        LAPORAN
                    </li>

                    <li class="<?= uri_string() === 'admin/laporan/dashboard' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/laporan/dashboard') ?>">
                            <i class="fas fa-file-alt"></i>
                            Laporan
                        </a>
                    </li>

                    <li class="sidebar-title">
                        AKUN
                    </li>

                    <li class="<?= strpos(uri_string(), 'admin/user/list') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/user/list') ?>">
                            <i class="fas fa-users"></i>
                            Kelola Akun
                        </a>
                    </li>

                <?php endif; ?>

                <li class="sidebar-title">
                    AKUN SAYA
                </li>

                <li class="<?= strpos(uri_string(), 'admin/profile') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/profile') ?>">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </li>

            </ul>

        </nav>

    </div>

    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </div>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">


</aside>