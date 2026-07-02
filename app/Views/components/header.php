<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="generator" content="CoolAdmin 3.3.0" />
    <meta name="description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
    <title> | CoolAdmin Bootstrap 5 Admin Dashboard</title>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Dashboard | CoolAdmin Bootstrap 5 Admin Dashboard" />
    <meta property="og:description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
    <meta property="og:image" content="screenshots/cooladmin-bootstrap-dashboard-2.png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Dashboard | CoolAdmin Bootstrap 5 Admin Dashboard" />
    <meta name="twitter:description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
    <meta name="theme-color" content="#4272d7" />
    <link href="<?= base_url('CoolAdmin-master/css/font-face.css') ?>" rel="stylesheet" media="all" />
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link href="<?= base_url('CoolAdmin-master/vendor/fontawesome-7.2.0/css/all.min.css') ?>" rel="stylesheet" media="all" />
    <link href="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.min.css') ?>" rel="stylesheet" media="all" />
    <link href="<?= base_url('CoolAdmin-master/vendor/css-hamburgers/hamburgers.min.css') ?>" rel="stylesheet" media="all" />
    <link href="<?= base_url('CoolAdmin-master/css/theme.css') ?>" rel="stylesheet" media="all" />
    <link href="<?= base_url('CoolAdmin-master/css/app.css') ?>" rel="stylesheet" media="all" />
    <link href="<?= base_url('assets/css/user/style.css') ?>" rel="stylesheet" media="all" />
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
</head>

<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="noti-wrap">
                    <!-- Jam & Tanggal -->
                    <div style="display:flex; flex-direction:column; align-items:flex-end; margin-right:16px; line-height:1.4;">
                        <span id="live-time" style="font-size:15px; font-weight:700; color:var(--m-text);"></span>
                        <span id="live-date" style="font-size:11px; color:var(--m-text-muted);"></span>
                    </div>
                </div>
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu" role="button" tabindex="0" aria-haspopup="true" aria-label="Account menu">
                            <!-- Foto Profile dari Session -->
                            <div class="image">
                                <img id="profile-image"
                                    src="<?= session()->get('foto_profil')
                                                ? base_url('uploads/profil/' . session()->get('foto_profil')) . '?v=' . time()
                                                : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                    alt="<?= session()->get('user_nama') ?? 'Profile' ?>"
                                    style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #f0f0f0;">
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">
                                    <?= session()->get('user_nama') ?? 'Guest' ?>
                                </a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="<?= base_url('admin/profile') ?>">
                                            <img id="dropdown-profile-image"
                                                src="<?= session()->get('user_foto')
                                                            ? base_url('uploads/profil/' . session()->get('user_foto')) . '?v=' . time()
                                                            : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                                alt="<?= session()->get('user_nama') ?? 'Profile' ?>"
                                                style="width:50px; height:50px; border-radius:50%; object-fit:cover; border:2px solid #f0f0f0;">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="<?= base_url('admin/profile') ?>">
                                                <?= session()->get('user_nama') ?? 'Guest' ?>
                                            </a>
                                        </h5>
                                        <span class="email"><?= session()->get('user_email') ?? 'guest@example.com' ?></span>
                                        <?php if (session()->get('user_role')): ?>
                                            <span style="display:block; font-size:11px; color:#999; margin-top:5px;">
                                                <span class="badge badge-<?= session()->get('user_role') == 'super_admin' ? 'danger' : 'primary' ?>">
                                                    <?= ucfirst(str_replace('_', ' ', session()->get('user_role'))) ?>
                                                </span>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .account-dropdown {
        min-width: 280px;
        right: 0;
        left: auto;
    }

    .account-dropdown .info .image {
        width: 50px;
        height: 50px;
    }

    .badge {
        display: inline-block;
        padding: 2px 10px;
        font-size: 10px;
        font-weight: 600;
        border-radius: 20px;
    }

    .badge-primary {
        background-color: #007bff;
        color: #fff;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #333;
    }

    .image img {
        border-radius: 50%;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .image img:hover {
        border-color: #007bff !important;
        transform: scale(1.05);
    }

    .account-dropdown__body {
        padding: 10px 0;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }

    .account-dropdown__item a {
        display: block;
        padding: 8px 20px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .account-dropdown__item a:hover {
        background-color: #f0f0f0;
        color: #007bff;
    }

    .account-dropdown__item i {
        margin-right: 10px;
        width: 20px;
    }

    .account-dropdown__footer {
        padding: 10px 20px;
    }

    .account-dropdown__footer a {
        color: #dc3545;
        text-decoration: none;
        display: block;
    }

    .account-dropdown__footer a:hover {
        color: #c82333;
    }

    .account-dropdown__footer i {
        margin-right: 10px;
    }
</style>

<script>
    function updateClock() {
        const now = new Date();
        const jam = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const hari = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('live-time').textContent = jam;
        document.getElementById('live-date').textContent = hari;
    }
    updateClock();
    setInterval(updateClock, 1000);

    function refreshProfilePhoto() {
        const userFoto = '<?= session()->get('user_foto') ?>';
        if (userFoto) {
            const baseUrl = '<?= base_url() ?>';
            const imagePath = baseUrl + 'uploads/profil/' + userFoto + '?t=' + new Date().getTime();
            const profileImg = document.getElementById('profile-image');
            const dropdownImg = document.getElementById('dropdown-profile-image');
            if (profileImg) profileImg.src = imagePath;
            if (dropdownImg) dropdownImg.src = imagePath;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('success_foto')): ?>
            window.location.reload();
        <?php endif; ?>
    });
</script>

<?php echo view('components/sidebar'); ?>

<style>
    .menu-sidebar .navbar__list li.has-sub>a::after,
    .menu-sidebar .navbar__list li>a.js-arrow::after,
    .navbar-mobile__list .js-arrow::after {
        display: none !important;
    }
</style>
