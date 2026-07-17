<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Geografis Pemetaan Sekolah Kabupaten Tanah Datar">
    <title>SIG Pemetaan Sekolah Kabupaten Tanah Datar</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="SIG Pemetaan Sekolah Kabupaten Tanah Datar">
    <meta property="og:description" content="Akses informasi spasial data pokok sekolah, sarana prasarana, peta zonasi PPDB, dan rute navigasi akurat.">
    <meta name="theme-color" content="#4272d7">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <link href="<?= base_url('CoolAdmin-master/css/font-face.css') ?>" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="<?= base_url('CoolAdmin-master/vendor/fontawesome-7.2.0/css/all.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('CoolAdmin-master/vendor/css-hamburgers/hamburgers.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('CoolAdmin-master/css/theme.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('CoolAdmin-master/css/app.css') ?>" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/landing/style.css'); ?>">
</head>

<body class="app">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand fw-bold text-primary me-0" href="#beranda">
                <i class="fa-solid fa-map-location-dot me-2"></i>
                <span class="d-none d-md-inline">SIG Sekolah Tanah Datar</span>
                <span class="d-md-none">SIG Sekolah</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-0 mb-lg-0 flex-row flex-wrap justify-content-end gap-1 gap-lg-2">
                    <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-center" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-center" href="#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-center" href="#pencarian">Pencarian</a></li>
            </div>
        </div>
    </nav>


    <header id="beranda" class="landing-header text-center">
        <div class="container d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="mb-2 text-center mx-auto">Jelajahi Sekolah di Kabupaten Tanah Datar</h1>
            <p class="mb-1 fw-semibold text-center mx-auto" style="font-size:1.2rem;">Temukan Sekolah dengan Mudah</p>
            <p class="text-center mx-auto" style="font-size:0.95rem; opacity:0.85; max-width:560px; margin: 0 auto;">
                Akses informasi lokasi, fasilitas, dan profil sekolah melalui peta digital yang interaktif dan mudah digunakan.
            </p>
        </div>
    </header>


    <main id="main-content">

        <!-- ringkasan -->
        <div id="statistik">
            <section class="stats-section">
                <div class="container">
                    <h2 class="text-center fw-bold mb-5">Ringkasan Data Spasial</h2>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <article class="stat-card text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:70px;height:70px;">
                                        <i class="fa-solid fa-school fa-2x text-primary"></i>
                                    </span>
                                </div>
                                <h1 class="fw-bold mb-1">
                                    <?= esc((string) ($totalSekolah ?? 0)) ?>
                                </h1>
                                <p class="text-secondary mb-0 fw-medium">
                                    Total Sekolah Terdata
                                </p>
                            </article>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <article class="stat-card text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:70px;height:70px;">
                                        <i class="fa-solid fas fa-child fa-2x text-primary"></i>
                                    </span>
                                </div>
                                <h1 class="fw-bold mb-1">
                                    <?= esc((string) ($totalTK ?? 0)) ?>
                                </h1>
                                <p class="text-secondary mb-0 fw-medium">
                                    Total Taman Kanak-Kanak (TK)
                                </p>
                            </article>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <article class="stat-card text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:70px;height:70px;">
                                        <i class="fa-solid fa-pencil fa-2x text-primary"></i>
                                    </span>
                                </div>
                                <h1 class="fw-bold mb-1">
                                    <?= esc((string) ($totalSD ?? 0)) ?>
                                </h1>
                                <p class="text-secondary mb-0 fw-medium">
                                    Total Sekolah Dasar (SD)
                                </p>
                            </article>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <article class="stat-card text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:70px;height:70px;">
                                        <i class="fa-solid fa-book-open fa-2x text-primary"></i>
                                    </span>
                                </div>
                                <h1 class="fw-bold mb-1">
                                    <?= esc((string) ($totalSMP ?? 0)) ?>
                                </h1>
                                <p class="text-secondary mb-0 fw-medium">
                                    Total Sekolah Menengah (SMP)
                                </p>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Pencarian + Peta -->
        <div class="container my-5" id="pencarian">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow feature-card p-4">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="fa-solid fa-sliders text-primary me-2"></i>Temukan Sekolah
                        </h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">
                                Pencarian Sekolah
                            </label>
                            <div class="input-group">
                                <input
                                    type="search"
                                    id="dt-search-input"
                                    class="form-control"
                                    placeholder="Cari nama sekolah..."
                                    aria-label="Search">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Jenjang Pendidikan</label>
                            <select id="filter-jenjang" class="form-select">
                                <option value="">Semua Jenjang (TK,SD, SMP)</option>
                                <option value="TK">Taman Kanak-Kanak (TK)</option>
                                <option value="SD">Sekolah Dasar Negeri (SDN)</option>
                                <option value="SMP">Sekolah Menengah Pertama Negeri (SMPN)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Wilayah Kecamatan</label>
                            <select id="filter-kecamatan" class="form-select">
                                <option value="">Semua Kecamatan</option>
                                <?php
                                $daftarKecamatan = array_unique(array_column($sekolah ?? [], 'kecamatan'));
                                ?>
                                <?php foreach ($daftarKecamatan as $kec): ?>
                                    <?php if ($kec): ?>
                                        <option value="<?= esc($kec) ?>"><?= esc($kec) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Akreditasi</label>
                            <select id="filter-akreditasi" class="form-select">
                                <option value="">Semua Akreditasi</option>
                                <?php
                                $daftarAkreditasi = array_unique(array_column(array_filter($sekolah ?? [], fn($s) => !empty($s['akreditasi'])), 'akreditasi'));

                                // Custom sort: A, B, C, ... urut alfabetis dulu,
                                // baru "Belum Terakreditasi" dipaksa selalu di paling akhir
                                usort($daftarAkreditasi, function ($a, $b) {
                                    if ($a === 'Belum Terakreditasi') return 1;
                                    if ($b === 'Belum Terakreditasi') return -1;
                                    return strcmp($a, $b);
                                });
                                ?>
                                <?php foreach ($daftarAkreditasi as $akred): ?>
                                    <?php if ($akred): ?>
                                        <option value="<?= esc($akred) ?>">Akreditasi <?= esc($akred) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button id="btn-cari-sekolah" class="btn btn-primary w-100 fw-bold mb-2 py-2">
                            <i class="fa-solid fa-search"></i> Cek Sekolah
                        </button>
                        <button id="btn-reset-filter" type="button" class="btn btn-outline-secondary w-100 fw-bold mb-2 py-2">
                            <i class="fa-solid fa-rotate-left"></i> Reset Filter
                        </button>
                        <div id="search-result-info" class="search-result-info"></div>
                        <hr>
                        <p class="small text-muted mb-2">Eksplorasi Peta</p>
                        <a href="<?= base_url('peta') ?>" class="btn btn-primary w-100 fw-bold mb-2 py-2">
                            <i class="fas fa-map-marked-alt"></i>Peta Interaktif
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border-0 shadow feature-card p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                            <h6 class="fw-bold mb-0">
                                <i class="fa-solid fa-map-location-dot text-primary me-2"></i>
                                Peta Sebaran Sekolah
                            </h6>
                            <span class="badge bg-success">
                                <i class="fa-solid fa-circle me-1" style="font-size:0.5rem;"></i>Live Data
                            </span>
                        </div>
                        <div class="map-canvas-mock">
                            <div id="map"></div>
                        </div>
                        <!-- Legenda Peta -->
                        <div class="map-legend">
                            <div class="map-legend__group">
                                <p>Tingkatan Sekolah</p>
                                <div class="map-legend__item"><span class="map-legend__dot" style="background:green;"></span> TK</div>
                                <div class="map-legend__item"><span class="map-legend__dot" style="background:red;"></span> SD</div>
                                <div class="map-legend__item"><span class="map-legend__dot" style="background:navy;"></span> SMP</div>
                            </div>
                            <?php if (!empty($geojson)): ?>
                                <div class="map-legend__group">
                                    <p style="margin:0 0 4px 0;">Wilayah Kecamatan</p>
                                    <div style="display:flex; flex-direction:column; flex-wrap:wrap; height:90px; gap:4px 16px;">
                                        <?php foreach ($geojson as $g): ?>
                                            <div class="map-legend__item" style="display:flex; align-items:center; gap:6px;">
                                                <span style="width:14px; height:14px; border-radius:4px; background:<?= esc($g['warna']) ?>; opacity:0.7; display:inline-block; flex-shrink:0;"></span>
                                                <span style="font-size:13px; white-space:nowrap;"><?= esc($g['nama_kecamatan']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <script>
                            window.SEKOLAH_DATA = <?= json_encode($sekolah ?? []) ?>;
                            window.GEOJSON_DATA = <?= json_encode($geojson ?? []) ?>;
                            window.MAPTILER_KEY = '<?= esc($maptilerKey ?? '') ?>';
                            window.FOTO_SEKOLAH_URL = '<?= base_url('uploads/sekolah') ?>';
                            window.SEKOLAH_DETAIL_URL = '<?= base_url('sekolah/') ?>';
                            window.MARKER_BASE_URL = '<?= base_url('assets/markers') ?>';
                        </script>
                        <script src="<?= base_url('assets/js/landing/script.js') ?>"></script>
                    </div>
                </div>
            </div>
        </div>

        <!--  Tentang  -->
        <!-- <section id="tentang-kami" class="py-5" style="background:#f9f9f9;">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 text-center">
                        <h2 class="fw-bold mb-4">Tentang Kami</h2>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            Anggota Kelompok -->
        <!-- <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal">
                                👥 Anggota Kelompok → Lihat Anggota
                            </button> -->
        <!-- GitHub Project -->
        <!-- <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#githubModal">
                                🐙 GitHub Project → Lihat Project
                            </button> -->
        <!-- Email Kami -->
        <!-- <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#emailModal">
                                ✉️ Email Kami → Lihat Email
                            </button> -->
        <!-- Instagram Kami -->
        <!-- <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#instagramModal">
                                📸 Instagram Kami → Lihat Instagram
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Modal Anggota -->
        <!-- <div class="modal fade" id="anggotaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Anggota Kelompok</h5>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>Daffa Abrar</li>
                            <li>Muhammad Rizki</li>
                            <li>Rafly Al-Razaq</li>
                            <li>Nabila Putri Asmi</li>
                            <li>Cici Indriani</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Modal GitHub -->
        <!-- <div class="modal fade" id="githubModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">GitHub Project</h5>
                    </div>
                    <div class="modal-body">
                        <p>Kunjungi project kami di <a href="https://github.com/ZEY00-ai/PBL" target="_blank">GitHub</a>.</p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Modal Email -->
        <!-- <div class="modal fade" id="emailModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Email Kami</h5>
                    </div>
                    <div class="modal-body">
                        <p>Hubungi kami di: <a href="daffaabrar630@gmail.com">daffaabrar630@gmail.com</a></p>
                        <p>Hubungi kami di: <a href="rizkiemhade300804@gmail.com">@rizkiemhade300804@gmail.com</a></p>
                        <p>Hubungi kami di: <a href="mailto:info@tanahdatarkab.go.id">info@tanahdatarkab.go.id</a></p>
                        <p>Hubungi kami di: <a href="mailto:info@tanahdatarkab.go.id">info@tanahdatarkab.go.id</a></p>
                        <p>Hubungi kami di: <a href="mailto:info@tanahdatarkab.go.id">info@tanahdatarkab.go.id</a></p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Modal Instagram -->
        <!-- <div class="modal fade" id="instagramModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Instagram Kami</h5>
                    </div>
                    <div class="modal-body">
                        <p>Ikuti kami di <a href="https://www.instagram.com/zey.15_/" target="_blank">@zey.15_</a></p>
                        <p>Ikuti kami di <a href="https://www.instagram.com/rizkiemhade_/" target="_blank">@rizkiemhade_</a></p>
                        <p>Ikuti kami di <a href="https://www.instagram.com/raflyalrazaq_/" target="_blank">@raflyalrazaq_</a></p>
                        <p>Ikuti kami di <a href="https://www.instagram.com/_nabilaptriasmi/" target="_blank">@_nabilaptriasmi</a></p>
                        <p>Ikuti kami di <a href="https://www.instagram.com/ciii27.__/" target="_blank">@ciii27.__</a></p>
                    </div>
                </div>
            </div>
        </div> -->


    </main>

    <!-- ══ FOOTER ══ -->
    <!-- <footer class="site-footer">
        <div class="container">
            <div class="row align-items-center g-2">
                <div class="col-12">
                    <p class="mb-1 fw-semibold footer-title">
                        <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                        SIG Pemetaan Sekolah Kabupaten Tanah Datar
                    </p>
                </div>
            </div>
        </div>
    </footer> -->

    <script src="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.bundle.min.js') ?>"></script>
    <script src="<?= base_url('CoolAdmin-master/js/main.js') ?>"></script>


</body>

</html>