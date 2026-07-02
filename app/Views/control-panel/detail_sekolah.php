<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($sekolah['nama_sekolah']) ?> - SIG Sekolah Tanah Datar</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="<?= base_url('CoolAdmin-master/vendor/fontawesome-7.2.0/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.min.css') ?>" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e5e9f0;
            --bg: #f7f9fc;
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text-main);
        }

        /* ===== Top bar ===== */
        .topbar {
            padding: 18px 0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
        }

        .back-btn:hover {
            color: var(--primary);
        }

        /* ===== Cards (base) ===== */
        .card-box {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 22px;
        }

        .card-box h5 {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-box h5 i {
            color: var(--primary);
            font-size: 13px;
        }

        /* ===== Profile Card ===== */
        .profile-card {
            display: flex;
            gap: 22px;
            align-items: center;
            margin-bottom: 16px;
        }

        .profile-photo {
            width: 110px;
            height: 110px;
            border-radius: 14px;
            object-fit: cover;
            flex-shrink: 0;
            background: var(--primary-light);
        }

        .profile-photo-placeholder {
            width: 110px;
            height: 110px;
            border-radius: 14px;
            flex-shrink: 0;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary);
        }

        .profile-info h1 {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0 0 8px;
            color: var(--text-main);
        }

        .profile-info .lokasi {
            font-size: 13.5px;
            color: var(--text-muted);
            margin: 0;
        }

        .badge-tingkatan {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
            color: #fff;
            margin-right: 6px;
            letter-spacing: .2px;
        }

        /* ===== Kotak info & kontak — seragam ===== */
        .stat-box {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            height: 100%;
        }

        .stat-box .icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .stat-box .stat-text {
            min-width: 0;
        }

        .stat-box .stat-label {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: 2px;
        }

        .stat-box .stat-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            text-decoration: none;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .stat-box a.stat-value:hover {
            color: var(--primary);
        }

        .stat-box .stat-value.empty {
            font-weight: 400;
            font-style: italic;
            color: #94a3b8;
        }

        /* ===== Map ===== */
        #map {
            height: 280px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 16px;
        }

        /* ===== Lokasi detail (di bawah peta) ===== */
        .lokasi-detail {
            display: flex;
            gap: 14px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .lokasi-item {
            flex: 1;
            min-width: 220px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13.5px;
        }

        .lokasi-item .icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .lokasi-item .lokasi-label {
            font-size: 11.5px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: 2px;
        }

        .lokasi-item .lokasi-value {
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.5;
        }

        /* ===== Visi Misi ===== */
        .visi-misi {
            line-height: 1.8;
            color: var(--text-muted);
            font-size: 13.5px;
            text-align: justify;
            margin: 0;
        }

        .btn-outline-primary {
            --bs-btn-color: var(--primary);
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-bg: var(--primary);
            --bs-btn-hover-border-color: var(--primary);
        }

        .section-gap {
            margin-bottom: 18px;
        }

        @media (max-width: 576px) {
            .profile-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Top bar -->
        <div class="topbar">
            <a href="<?= base_url('/') ?>" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Profile Card -->
        <div class="card-box profile-card">
            <?php if (!empty($sekolah['foto'])): ?>
                <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                    alt="Foto <?= esc($sekolah['nama_sekolah']) ?>"
                    class="profile-photo">
            <?php else: ?>
                <div class="profile-photo-placeholder">
                    <i class="fa-solid fa-school"></i>
                </div>
            <?php endif; ?>

            <div class="profile-info">
                <h1><?= esc($sekolah['nama_sekolah']) ?></h1>

                <div class="mb-2">
                    <?php
                    $tingkatanColor = match ($sekolah['tingkatan'] ?? '') {
                        'TK'  => '#16a34a',
                        'SD'  => '#dc2626',
                        'SMP' => '#1e3a8a',
                        default => '#475569',
                    };
                    ?>
                    <span class="badge-tingkatan" style="background:<?= $tingkatanColor ?>;">
                        <?= esc($sekolah['tingkatan'] ?? '-') ?>
                    </span>
                    <?php if (!empty($sekolah['akreditasi'])): ?>
                        <?php
                        $akrColor = match ($sekolah['akreditasi']) {
                            'A'    => '#16a34a',
                            'B'    => '#2563eb',
                            'C'    => '#d97706',
                            default => '#6b7280',
                        };
                        ?>
                        <span class="badge-tingkatan" style="background:<?= $akrColor ?>;">
                            Akreditasi <?= esc($sekolah['akreditasi']) ?>
                        </span>
                    <?php endif; ?>
                    <span class="badge-tingkatan" style="background:#0f172a;">
                        NPSN <?= esc($sekolah['npsn'] ?? '-') ?>
                    </span>
                </div>

                <p class="lokasi"><i class="fa-solid fa-location-dot me-1"></i><?= esc($sekolah['kecamatan'] ?? '-') ?>, Kabupaten Tanah Datar</p>
            </div>
        </div>

        <!-- Kepala Sekolah + Telepon + Email + Website — 4 kotak sejajar -->
        <div class="row g-3 section-gap">
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="icon-box"><i class="fa-solid fa-user-tie"></i></span>
                    <div class="stat-text">
                        <div class="stat-label">Kepala Sekolah</div>
                        <span class="stat-value"><?= esc($sekolah['kepala_sekolah'] ?? '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="icon-box"><i class="fa-solid fa-phone"></i></span>
                    <div class="stat-text">
                        <div class="stat-label">Telepon</div>
                        <?php if (!empty($sekolah['nomor_sekolah'])): ?>
                            <span class="stat-value"><?= esc($sekolah['nomor_sekolah']) ?></span>
                        <?php else: ?>
                            <span class="stat-value empty">Belum tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="icon-box"><i class="fa-solid fa-envelope"></i></span>
                    <div class="stat-text">
                        <div class="stat-label">Email</div>
                        <?php if (!empty($sekolah['email'])): ?>
                            <a href="mailto:<?= esc($sekolah['email']) ?>" class="stat-value"><?= esc($sekolah['email']) ?></a>
                        <?php else: ?>
                            <span class="stat-value empty">Belum tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="icon-box"><i class="fa-solid fa-globe"></i></span>
                    <div class="stat-text">
                        <div class="stat-label">Website</div>
                        <?php if (!empty($sekolah['website'])): ?>
                            <a href="<?= esc($sekolah['website']) ?>" target="_blank" class="stat-value"><?= esc($sekolah['website']) ?></a>
                        <?php else: ?>
                            <span class="stat-value empty">Belum tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi Sekolah — full width -->
        <div class="card-box section-gap">
            <h5><i class="fa-solid fa-map-location-dot"></i> Lokasi Sekolah</h5>

            <div id="map"></div>

            <div class="lokasi-detail">
                <div class="lokasi-item">
                    <span class="icon-box"><i class="fa-solid fa-map"></i></span>
                    <div>
                        <div class="lokasi-label">Kecamatan</div>
                        <div class="lokasi-value"><?= esc($sekolah['kecamatan'] ?? '-') ?></div>
                    </div>
                </div>
                <div class="lokasi-item">
                    <span class="icon-box"><i class="fa-solid fa-location-dot"></i></span>
                    <div>
                        <div class="lokasi-label">Alamat</div>
                        <div class="lokasi-value"><?= esc($sekolah['alamat'] ?? '-') ?></div>
                    </div>
                </div>
            </div>

            <a href="https://www.google.com/maps?q=<?= $sekolah['latitude'] ?>,<?= $sekolah['longitude'] ?>"
                target="_blank"
                class="btn btn-outline-primary btn-sm">
                <i class="fa-brands fa-google me-1"></i> Buka di Google Maps
            </a>
        </div>

        <!-- Visi & Misi -->
        <?php if (!empty($sekolah['visi']) || !empty($sekolah['misi'])): ?>
            <div class="row g-3 section-gap">
                <?php if (!empty($sekolah['visi'])): ?>
                    <div class="col-md-6">
                        <div class="card-box h-100">
                            <h5><i class="fa-solid fa-eye"></i> Visi</h5>
                            <p class="visi-misi"><?= nl2br(esc($sekolah['visi'])) ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($sekolah['misi'])): ?>
                    <div class="col-md-6">
                        <div class="card-box h-100">
                            <h5><i class="fa-solid fa-bullseye"></i> Misi</h5>
                            <p class="visi-misi"><?= nl2br(esc($sekolah['misi'])) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 fw-bold">
                        <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                        SIG Pemetaan Sekolah Kabupaten Tanah Datar
                    </p>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <small class="text-muted">&copy; <?= date('Y') ?> Dinas Pendidikan Kabupaten Tanah Datar</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.bundle.min.js') ?>"></script>
    <script>
        <?php if ($sekolah['latitude'] && $sekolah['longitude']): ?>
            const lat = <?= $sekolah['latitude'] ?>;
            const lng = <?= $sekolah['longitude'] ?>;

            const map = L.map('map').setView([lat, lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`
            <div style="min-width:160px;">
                <strong><?= esc($sekolah['nama_sekolah']) ?></strong><br>
                <small><?= esc($sekolah['kecamatan'] ?? '') ?></small><br>
                <small><?= esc($sekolah['alamat'] ?? '') ?></small>
            </div>
        `).openPopup();

            L.circle([lat, lng], {
                color: '#2563eb',
                fillColor: '#2563eb',
                fillOpacity: 0.1,
                radius: 300
            }).addTo(map);
        <?php endif; ?>
    </script>
</body>

</html>