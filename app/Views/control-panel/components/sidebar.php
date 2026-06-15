<aside class="menu-sidebar" id="main-sidebar">
    <div class="logo"><a class="logo-link" href="index.html" aria-label="CoolAdmin home"><span class="logo-mark" aria-hidden="true">C</span><span class="logo-text">CoolAdmin</span></a>
        <button class="sidebar-close js-sidebar-toggle" type="button" aria-label="Close navigation"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">


                <li class="<?= uri_string() === 'dashboard' ? 'active' : '' ?> has-sub">
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fa-solid fa-home mb-1"></i>Dashboard
                    </a>
                </li>
                <li class="<?= strpos(uri_string(), 'user') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('user/list') ?>">
                        <i class="fa-solid fa-users mb-1"></i>Data User
                    </a>
                </li>
                <li class="<?= strpos(uri_string(), 'admin/sekolah') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/sekolah') ?>">
                        <i class="fa-solid fa-chart-bar   mb-1"></i>Data Sekolah
                    </a>
                </li>
                <li class="<?= strpos(uri_string(), 'geojson') === 0 ? 'active' : '' ?>">
                    <a href="<?= base_url('geojson/list') ?>">
                        <i class="fa-solid fa-calendar-alt"></i>Data GeoJson
                    </a>
                </li>
                <li class="<?= uri_string() === 'maps/index' ? 'active' : '' ?>">
                    <a href="<?= base_url('maps/index') ?>">
                        <i class="fa-solid fa-calendar-alt"></i>maps Sekolah & GeoJson
                    </a>
                </li>
                <li class="<?= uri_string() === 'laporan/dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('laporan/dashboard') ?>">
                        <i class="fa-solid fa-calendar-alt"></i>Laporan
                    </a>
                </li>
                <li class="<?= uri_string() === 'profile/dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('profile/dashboard') ?>">
                        <i class="fa-solid fa-user mb-2"></i>Profile
                    </a>
                </li>


                <!-- Operator Maps -->

                <!-- <?php if (session()->get('user_role') === 'operator_maps'): ?>
                    <li class="<?= uri_string() === 'operator-maps/dashboard' ? 'active' : '' ?> has-sub">
                        <a href="<?= base_url('operator-maps/dashboard') ?>">
                            <i class="fa-solid fa-home mb-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/input-data-sekolah' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/input-data-sekolah') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Input Data Sekolah
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/input-geojson' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/input-geojson') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Input GeoJson
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/geojson/list' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/geojson/list') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>List GeoJson
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/sekolah/peta' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/sekolah/peta') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>maps Sekolah & GeoJson
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/sekolah' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/sekolah') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>List Sekolah
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-maps/profile' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/profile') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Profile
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('user_role') === 'operator_dinas'): ?>
                    <li class="<?= uri_string() === 'operator-dinas/dashboard' ? 'active' : '' ?> has-sub">
                        <a href="<?= base_url('operator-dinas/dashboard') ?>">
                            <i class="fa-solid fa-home mb-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-dinas/laporan-penyebaran-sekolah' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-dinas/laporan-penyebaran-sekolah') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Laporan Penyebaran Sekolah
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-dinas/laporan-perkecamatan' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-dinas/laporan-perkecamatan') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Laporan perkecamatan
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-dinas/analisis-data' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-dinas/analisis-data') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>analisis Data
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-dinas/export-data' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-dinas/export-data') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Export Data
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'operator-dinas/profile' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-dinas/profile') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Profile
                        </a>
                    </li>
                <?php endif; ?> -->
            </ul>
        </nav>
    </div>
</aside>