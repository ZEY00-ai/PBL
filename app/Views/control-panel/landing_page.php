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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex w-100 justify-content-between align-items-center flex-column flex-lg-row">

                    <div style="width: 600px;" class="d-none d-lg-block"></div>

                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pencarian">Pencarian</a></li>
                        <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    </ul>

                    <div style="width: 100px;" class="text-lg-end w-100 w-lg-auto mt-2 mt-lg-0">
                        <a href="<?= base_url('login') ?>" class="btn btn-primary btn-sm px-4">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>Panel Admin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>


    <header id="beranda" class="landing-header text-center">
        <div class="container">
            <h1 class="mb-2">Jelajahi Sekolah di Kabupaten Tanah Datar</h1>
            <p class="mb-1 fw-semibold" style="font-size:1.2rem;">Temukan Sekolah dengan Mudah</p>
            <p style="font-size:0.95rem; opacity:0.85; max-width:560px; margin: 0 auto;">
                Akses informasi lokasi, fasilitas, dan profil sekolah melalui peta digital yang interaktif dan mudah digunakan.
            </p>
        </div>
    </header>

    <!-- Statistik -->
    <section id="statistik" class="stats-section">
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
                            <?= esc((string) ($totalTerverifikasi ?? 0)) ?>
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
                            <?= esc((string) ($totalTerverifikasi ?? 0)) ?>
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
                            <?= esc((string) ($totalTerverifikasi ?? 0)) ?>
                        </h1>
                        <p class="text-secondary mb-0 fw-medium">
                            Total Sekolah Menengah (SMP)
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

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
                            <select class="form-select">
                                <option>Semua Jenjang (TK,SD, SMP)</option>
                                <option>Teman Kanak-Kanak (TK)</option>
                                <option>Sekolah Dasar Negeri (SDN)</option>
                                <option>Sekolah Menengah Pertama Negeri (SMPN)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Wilayah Kecamatan</label>
                            <select class="form-select">
                                <option>Semua Kecamatan</option>
                                <option>Kecamatan Lintau Buo</option>
                                <option>Kecamatan Padang Gantiang</option>
                                <option>Kecamatan Tanjung Ameh</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Akreditasi</label>
                            <select class="form-select">
                                <option>Semua Akreditasi</option>
                                <option>Akreditasi A</option>
                                <option>Akreditasi B</option>
                            </select>
                        </div>

                        <button class="btn btn-primary w-100 fw-bold mb-2 py-2">
                            <i class="fa-solid fa-search"></i>Cek Sekolah
                        </button>

                        <hr>
                        <p class="small text-muted mb-2">Eksplorasi Peta</p>
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary w-100 fw-bold mb-2 py-2">
                            <i class="fas fa-map-marked-alt"></i>Peta Interaktif
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

                            const tileLayerUrl = maptilerKey ?
                                `https://api.maptiler.com/maps/streets/256/{z}/{x}/{y}.png?key=${maptilerKey}` :
                                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

                            const tileLayerAttribution = maptilerKey ?
                                '© MapTiler © OpenStreetMap contributors' :
                                '&copy; OpenStreetMap contributors';

                            const streets = L.tileLayer(tileLayerUrl, {
                                attribution: tileLayerAttribution,
                                maxZoom: 19
                            });

                            const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                                attribution: '&copy; OpenStreetMap & CartoDB',
                                maxZoom: 19
                            });

                            const satellite = maptilerKey ?
                                L.tileLayer(`https://api.maptiler.com/maps/hybrid/256/{z}/{x}/{y}.png?key=${maptilerKey}`, {
                                    attribution: '© MapTiler © OpenStreetMap contributors',
                                    maxZoom: 19
                                }) :
                                L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
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
                            sekolah.forEach(function(s) {
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