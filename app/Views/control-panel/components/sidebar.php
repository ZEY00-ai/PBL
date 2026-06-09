<aside class="menu-sidebar" id="main-sidebar">
    <div class="logo"><a class="logo-link" href="index.html" aria-label="CoolAdmin home"><span class="logo-mark" aria-hidden="true">C</span><span class="logo-text">CoolAdmin</span></a>
        <button class="sidebar-close js-sidebar-toggle" type="button" aria-label="Close navigation"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <!-- admin sistem -->
                <?php if (session()->get('user_role') === 'admin_sistem'): ?>
                    <li class="<?= uri_string() === 'admin/dashboard' ? 'active' : '' ?> has-sub">
                        <a href="<?= base_url('admin/dashboard') ?>">
                            <i class="fa-solid fa-home mb-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'admin/kelolaUser' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/kelolaUser') ?>">
                            <i class="fa-solid fa-users mb-2"></i>Kelola User
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'admin/log-aktivitas' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/log-aktivitas') ?>">
                            <i class="fa-solid fa-chart-bar mb-2"></i>Log Aktivitas
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'admin/konfigurasi' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/konfigurasi') ?>">
                            <i class="fa-solid fa-cog mb-2"></i>Konfigurasi Sistem
                        </a>
                    </li>
                    <li class="<?= uri_string() === 'admin/profile' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/profile') ?>">
                            <i class="fa-solid fa-user mb-2"></i>Profile
                        </a>
                    </li>
                <?php endif; ?>


                <!-- Operator Maps -->

                <?php if (session()->get('user_role') === 'operator_maps'): ?>
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
                    <li class="<?= uri_string() === 'operator-maps/sekolah/peta' ? 'active' : '' ?>">
                        <a href="<?= base_url('operator-maps/sekolah/peta') ?>">
                            <i class="fa-solid fa-calendar-alt"></i>Peta Sekolah
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

                <!-- operator dinas -->

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
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>