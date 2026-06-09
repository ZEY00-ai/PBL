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
    <!-- Make sure you put this AFTER Leaflet's CSS -->
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

    <style>
        /* Hanya override minimal yang diperlukan untuk layout landing */
        .landing-header {
            background: linear-gradient(135deg, #4272d7 0%, #2d5aa6 100%);
            padding: 80px 0;
        }

        .landing-header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
        }

        .landing-header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .map-canvas-mock {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            border: 2px dashed #0284c7;
            color: #0284c7;
            min-height: 520px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .map-canvas-mock::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(2, 132, 199, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(2, 132, 199, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .map-canvas-mock>* {
            position: relative;
            z-index: 1;
        }

        .map-canvas-mock #map {
            width: 100%;
            flex: 1;
            min-height: 420px;
        }

        .map-canvas-caption {
            padding: 1rem 1.25rem 1.25rem;
            text-align: center;
        }

        /* Pulse marker animasi di peta */
        .map-pulse {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #4272d7;
            z-index: 2;
        }

        .map-pulse::after {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            border: 2px solid #4272d7;
            animation: mapPulse 2s ease-in-out infinite;
        }

        @keyframes mapPulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(2.8);
                opacity: 0;
            }
        }

        .map-pulse:nth-child(1) {
            top: 32%;
            left: 28%;
        }

        .map-pulse:nth-child(2) {
            top: 55%;
            left: 58%;
            animation-delay: 0.8s;
        }

        .map-pulse:nth-child(3) {
            top: 38%;
            left: 72%;
            animation-delay: 1.5s;
        }

        .stats-section {
            background: #f8fafc;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 30px;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            color: #4272d7;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            color: #64748b;
            font-size: 1.05rem;
        }

        /* Hero CTA buttons */
        .hero-cta {
            margin-top: 2rem;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
</head>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>

    <!-- ══ NAVBAR ══ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fa-solid fa-map-location-dot me-2"></i>
                <span class="d-none d-md-inline">SIG Sekolah Tanah Datar</span>
                <span class="d-md-none">SIG Sekolah</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pencarian">Pencarian</a></li>
                    <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                </ul>
                <div class="d-flex gap-2 mt-2 mt-lg-0">
                    <a href="<?= base_url('login') ?>" class="btn btn-primary btn-sm px-4">
                        <i class="fa-solid fa-right-to-bracket me-1"></i>Login
                    </a>
                    <a href="<?= base_url('register') ?>" class="btn btn-outline-primary btn-sm px-4">
                        <i class="fa-solid fa-user-plus me-1"></i>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ══ HERO ══ -->
    <header id="beranda" class="landing-header text-center">
        <div class="container">
            <h1 class="mb-2">Temukan &amp; Petakan Sekolah</h1>
            <p class="mb-1 fw-semibold" style="font-size:1.2rem;">Kabupaten Tanah Datar</p>
            <p style="font-size:0.95rem; opacity:0.85; max-width:560px; margin: 0 auto;">
                Akses informasi spasial data pokok sekolah, sarana prasarana, peta zonasi PPDB, dan rute navigasi akurat
            </p>
            <div class="hero-cta">
                <a href="<?= base_url('auth/login') ?>" class="btn btn-light btn-lg px-5 fw-bold">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk Sistem
                </a>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-light btn-lg px-5 fw-bold">
                    <i class="fa-solid fa-user-plus me-2"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- ══ MAIN CONTENT ══ -->
    <main id="main-content">

        <!-- Pencarian Spasial + Peta -->
        <div class="container my-5" id="pencarian">
            <div class="row g-4">

                <!-- Filter Panel -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow feature-card p-4">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="fa-solid fa-sliders text-primary me-2"></i>Pencarian Spasial
                        </h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Jenjang Pendidikan</label>
                            <select class="form-select">
                                <option>Semua Jenjang (SD, SMP)</option>
                                <option>SD Negeri / Swasta</option>
                                <option>SMP Negeri</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Radius Jarak</label>
                            <select class="form-select">
                                <option>Dalam Radius 1 KM</option>
                                <option>Dalam Radius 3 KM</option>
                                <option>Dalam Radius 5 KM</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Wilayah Kecamatan</label>
                            <select class="form-select">
                                <option>Semua Kecamatan</option>
                                <option>Kecamatan Lima Kaum</option>
                                <option>Kecamatan Tanjung Emas</option>
                                <option>Kecamatan Lintau Buo</option>
                                <option>Kecamatan Batipuh</option>
                                <option>Kecamatan Pariangan</option>
                            </select>
                        </div>

                        <button class="btn btn-outline-primary w-100 fw-bold mb-2 py-2">
                            <i class="fa-solid fa-layer-group me-2"></i>Peta Zonasi PPDB
                        </button>
                        <button class="btn btn-success w-100 fw-bold mb-3 py-2">
                            <i class="fa-solid fa-calculator me-2"></i>Cek Kelayakan
                        </button>

                        <hr>
                        <p class="small text-muted mb-2">Akses fitur lengkap sistem:</p>
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary w-100 fw-bold mb-2 py-2">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login ke Sistem
                        </a>
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-primary w-100 fw-bold py-2">
                            <i class="fa-solid fa-user-plus me-2"></i>Buat Akun Baru
                        </a>
                    </div>
                </div>

                <!-- Peta Interaktif -->
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

                        <script>
                            const sekolah = <?= json_encode($sekolah ?? []) ?>;
                            const maptilerKey = '<?= esc($maptilerKey ?? '') ?>';

                            const tileLayerUrl = maptilerKey
                                ? `https://api.maptiler.com/maps/streets/256/{z}/{x}/{y}.png?key=${maptilerKey}`
                                : 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

                            const tileLayerAttribution = maptilerKey
                                ? '© MapTiler © OpenStreetMap contributors'
                                : '&copy; OpenStreetMap contributors';

                            const streets = L.tileLayer(tileLayerUrl, {
                                attribution: tileLayerAttribution,
                                maxZoom: 19
                            });

                            const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                                attribution: '&copy; OpenStreetMap & CartoDB',
                                maxZoom: 19
                            });

                            const satellite = maptilerKey
                                ? L.tileLayer(`https://api.maptiler.com/maps/hybrid/256/{z}/{x}/{y}.png?key=${maptilerKey}`, {
                                    attribution: '© MapTiler © OpenStreetMap contributors',
                                    maxZoom: 19
                                })
                                : L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                                    attribution: 'Tiles © Esri',
                                    maxZoom: 19
                                });

                            const map = L.map('map', {
                                center: [-0.2733009989610224, 100.48442111207578],
                                zoom: 12,
                                layers: [streets]
                            });

                            const baseLayers = {
                                'Streets': streets,
                                'Dark': dark,
                                'Satellite': satellite
                            };

                            L.control.layers(baseLayers, null, {
                                collapsed: false
                            }).addTo(map);

                            const bounds = [];
                            sekolah.forEach(function (s) {
                                if (!s.latitude || !s.longitude) {
                                    return;
                                }

                                const lat = parseFloat(s.latitude);
                                const lng = parseFloat(s.longitude);
                                if (Number.isNaN(lat) || Number.isNaN(lng)) {
                                    return;
                                }

                                const marker = L.marker([lat, lng]).addTo(map);
                                const popupContent = `
                                    <div style="min-width:200px;">
                                        <strong>${s.nama_sekolah}</strong><br>
                                        <small>${s.kecamatan || ''}</small><br>
                                        <p class="small mb-1">${s.alamat || ''}</p>
                                        ${s.foto ? `<img src="<?= base_url('uploads/sekolah') ?>/${s.foto}" alt="Foto sekolah" style="width:100%; height:100px; object-fit:cover; border-radius:6px;">` : ''}
                                    </div>
                                `;
                                marker.bindPopup(popupContent);
                                bounds.push([lat, lng]);
                            });

                            if (bounds.length) {
                                map.fitBounds(bounds, {
                                    padding: [40, 40]
                                });
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>

        <!-- Statistik -->
        <section id="statistik" class="stats-section">
            <div class="container">
                <h2 class="text-center fw-bold mb-5">Ringkasan Data Spasial</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <h3><?= esc((string) ($totalSekolah ?? 0)) ?></h3>
                            <p>Total Sekolah Terdata</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <h3 style="color:#10b981;"><?= esc((string) ($totalTerverifikasi ?? 0)) ?></h3>
                            <p>Terverifikasi Spasial</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <h3 style="color:#0ea5e9;">91.4%</h3>
                            <p>Rasio Kelayakan Zonasi</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <h3 style="color:#f59e0b;">B+</h3>
                            <p>Rata-rata Sarpras</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur Utama -->
        <div class="container my-5" id="fitur">
            <h2 class="text-center fw-bold mb-5">Fitur Utama Sistem</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-map-pin fa-3x text-primary mb-3"></i>
                        <h6 class="fw-bold">Pemetaan Lokasi</h6>
                        <p class="small text-muted">Visualisasi spasial data sekolah dengan GPS presisi tinggi</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-chart-bar fa-3x text-success mb-3"></i>
                        <h6 class="fw-bold">Analitik Data</h6>
                        <p class="small text-muted">Dashboard statistik lengkap sarana prasarana sekolah</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h6 class="fw-bold">Export Laporan</h6>
                        <p class="small text-muted">Cetak dan ekspor data dalam format PDF profesional</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-shield-halved fa-3x text-warning mb-3"></i>
                        <h6 class="fw-bold">Keamanan Data</h6>
                        <p class="small text-muted">Sistem akses terkontrol dengan enkripsi data maksimal</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-arrows-to-dot fa-3x text-info mb-3"></i>
                        <h6 class="fw-bold">Zonasi PPDB</h6>
                        <p class="small text-muted">Simulasi peta zonasi PPDB berdasarkan jarak tempuh siswa</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-route fa-3x text-secondary mb-3"></i>
                        <h6 class="fw-bold">Navigasi Rute</h6>
                        <p class="small text-muted">Rute navigasi akurat dari lokasi siswa ke sekolah pilihan</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-boxes-stacked fa-3x text-primary mb-3"></i>
                        <h6 class="fw-bold">Inventaris Sarpras</h6>
                        <p class="small text-muted">Pengelolaan inventaris sarana dan prasarana sekolah secara digital</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow feature-card text-center p-4">
                        <i class="fa-solid fa-circle-check fa-3x text-success mb-3"></i>
                        <h6 class="fw-bold">Verifikasi Lapangan</h6>
                        <p class="small text-muted">Alur validasi data lapangan oleh surveyor dengan tracking progres</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ══ FOOTER ══ -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-1 fw-bold">
                        <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                        SIG Pemetaan Sekolah Kabupaten Tanah Datar
                    </p>
                    <small class="text-muted">Sistem Informasi Geografis untuk manajemen data spasial sekolah</small>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <small class="text-muted">&copy; 2026 Dinas Pendidikan Kabupaten Tanah Datar. All rights reserved.</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.bundle.min.js') ?>"></script>
    <script src="<?= base_url('CoolAdmin-master/js/main.js') ?>"></script>
</body>

</html>