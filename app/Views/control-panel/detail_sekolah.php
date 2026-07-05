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
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --accent: #06b6d4;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e5e9f0;
            --bg: #f4f7fb;
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
            transition: color .2s ease;
        }

        .back-btn:hover {
            color: var(--primary);
        }

        /* ===== Cards (base) ===== */
        .card-box {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 24px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
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

        /* ===== Header Sekolah (judul + alamat singkat) ===== */
        .school-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .school-header h1 {
            font-size: 1.55rem;
            font-weight: 800;
            margin: 0 0 6px;
            color: var(--text-main);
        }

        .school-header .lokasi {
            font-size: 13.5px;
            color: var(--text-muted);
            margin: 0;
        }

        .btn-aksi {
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid #dbe6fb;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 13.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-aksi:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* ===== Baris atas: foto besar (kiri) + kartu info (kanan) ===== */
        .top-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
            align-items: stretch;
        }

        @media (max-width: 860px) {
            .top-grid {
                grid-template-columns: 1fr;
            }
        }

        .photo-box {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
            min-height: 300px;
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            min-height: 300px;
            object-fit: cover;
            display: block;
            transition: transform .4s ease;
        }

        .photo-box:hover .profile-photo {
            transform: scale(1.04);
        }

        .profile-photo-placeholder {
            width: 100%;
            height: 100%;
            min-height: 300px;
            background: linear-gradient(135deg, var(--primary-light), #e0ecff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary);
        }

        .photo-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            z-index: 1;
        }

        .badge-tingkatan {
            display: inline-block;
            padding: 4px 13px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            color: #fff;
            letter-spacing: .3px;
            background: var(--primary);
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.18);
        }

        /* ===== Kartu info grid (mirip referensi) ===== */
        .info-card {
            border-radius: 16px;
            border: 1px solid var(--border);
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
            padding: 22px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 16px;
            align-content: start;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-item .icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .info-item .info-label {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: 3px;
        }

        .info-item .info-value {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
            text-decoration: none;
            display: block;
            word-break: break-word;
        }

        .info-item a.info-value:hover {
            color: var(--primary);
        }

        .info-item .info-value.empty {
            font-weight: 400;
            font-style: italic;
            color: #94a3b8;
        }

        /* ===== Kotak info & kontak — seragam ===== */
        .stat-box {
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border);
            padding: 15px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            height: 100%;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.07);
            border-color: var(--primary);
        }

        .stat-box .icon-box {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
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
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 16px;
        }

        /* ===== Lokasi detail (di bawah peta) ===== */
        .lokasi-detail {
            display: flex;
            gap: 14px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .lokasi-item {
            flex: 1;
            min-width: 220px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13.5px;
            background: var(--bg);
            border-radius: 12px;
            padding: 12px 14px;
        }

        .lokasi-item .icon-box {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #fff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.06);
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
            border-radius: 8px;
            font-weight: 600;
        }

        .section-gap {
            margin-bottom: 18px;
        }

        @media (max-width: 576px) {
            .school-header {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-aksi {
                justify-content: center;
            }

            .info-card {
                grid-template-columns: 1fr;
            }

            .photo-box,
            .profile-photo,
            .profile-photo-placeholder {
                min-height: 220px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Top bar -->
        <div class="topbar">
            <a href="<?= esc($backUrl ?? base_url('/')) ?>" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Header: Nama Sekolah + Alamat singkat -->
        <div class="school-header">
            <div>
                <h1><?= esc($sekolah['nama_sekolah']) ?></h1>
                <p class="lokasi"><?= esc($sekolah['kecamatan'] ?? '-') ?>, Kabupaten Tanah Datar<?= !empty($sekolah['alamat']) ? ' — ' . esc($sekolah['alamat']) : '' ?></p>
            </div>
        </div>

        <!-- Baris atas: Foto besar (kiri) + Kartu Info (kanan) -->
        <div class="top-grid">

            <!-- Foto Sekolah -->
            <div class="photo-box">
                <div class="photo-badge">
                    <?php
                    $tingkatanColor = match ($sekolah['tingkatan'] ?? '') {
                        'TK'  => '#16a34a',
                        'SD'  => '#dc2626',
                        'SMP' => '#1e3a8a',
                        default => '#475569',
                    };
                    ?>
                    <span class="badge-tingkatan" style="background:<?= $tingkatanColor ?>;"><?= esc($sekolah['tingkatan'] ?? '-') ?></span>
                    <?php if (!empty($sekolah['akreditasi'])): ?>
                        <span class="badge-tingkatan">Akreditasi <?= esc($sekolah['akreditasi']) ?></span>
                    <?php endif; ?>
                </div>

                <?php if (!empty($sekolah['foto'])): ?>
                    <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                        alt="Foto <?= esc($sekolah['nama_sekolah']) ?>"
                        class="profile-photo">
                <?php else: ?>
                    <div class="profile-photo-placeholder">
                        <i class="fa-solid fa-school"></i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kartu Informasi -->
            <div class="info-card">

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-star"></i></span>
                    <div>
                        <div class="info-label">Akreditasi</div>
                        <span class="info-value<?= empty($sekolah['akreditasi']) ? ' empty' : '' ?>"><?= esc($sekolah['akreditasi'] ?? 'Belum Terisi') ?></span>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-hashtag"></i></span>
                    <div>
                        <div class="info-label">NPSN</div>
                        <span class="info-value"><?= esc($sekolah['npsn'] ?? '-') ?></span>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-layer-group"></i></span>
                    <div>
                        <div class="info-label">Tingkatan</div>
                        <span class="info-value"><?= esc($sekolah['tingkatan'] ?? '-') ?></span>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-user-tie"></i></span>
                    <div>
                        <div class="info-label">Kepala Sekolah</div>
                        <span class="info-value<?= empty($sekolah['kepala_sekolah']) ? ' empty' : '' ?>"><?= esc($sekolah['kepala_sekolah'] ?? 'Belum Terisi') ?></span>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-phone"></i></span>
                    <div>
                        <div class="info-label">Telepon</div>
                        <?php if (!empty($sekolah['nomor_sekolah'])): ?>
                            <span class="info-value"><?= esc($sekolah['nomor_sekolah']) ?></span>
                        <?php else: ?>
                            <span class="info-value empty">Belum Terisi</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-envelope"></i></span>
                    <div>
                        <div class="info-label">Email</div>
                        <?php if (!empty($sekolah['email'])): ?>
                            <a href="mailto:<?= esc($sekolah['email']) ?>" class="info-value"><?= esc($sekolah['email']) ?></a>
                        <?php else: ?>
                            <span class="info-value empty">Belum Terisi</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-globe"></i></span>
                    <div>
                        <div class="info-label">Website Sekolah</div>
                        <?php if (!empty($sekolah['website'])): ?>
                            <a href="<?= esc($sekolah['website']) ?>" target="_blank" class="info-value"><?= esc($sekolah['website']) ?></a>
                        <?php else: ?>
                            <span class="info-value empty">Belum Terisi</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon-box"><i class="fa-solid fa-map"></i></span>
                    <div>
                        <div class="info-label">Kecamatan</div>
                        <span class="info-value"><?= esc($sekolah['kecamatan'] ?? '-') ?></span>
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
    const GEOJSON_DATA = <?= json_encode($geojson ?? []) ?>;
    const SEKOLAH_KECAMATAN = <?= json_encode($sekolah['kecamatan'] ?? '') ?>;

    <?php if ($sekolah['latitude'] && $sekolah['longitude']): ?>
        const lat = <?= $sekolah['latitude'] ?>;
        const lng = <?= $sekolah['longitude'] ?>;

        const map = L.map('map').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // ── Render HANYA batas wilayah kecamatan sekolah ini ───────
        const geoKecamatan = GEOJSON_DATA.find(function (item) {
            return item.nama_kecamatan === SEKOLAH_KECAMATAN;
        });

        if (geoKecamatan) {
            try {
                const geoData = typeof geoKecamatan.geojson === 'string'
                    ? JSON.parse(geoKecamatan.geojson)
                    : geoKecamatan.geojson;

                L.geoJSON(geoData, {
                    style: {
                        color: geoKecamatan.warna,
                        weight: 2,
                        fillColor: geoKecamatan.warna,
                        fillOpacity: 0.25,
                    },
                    onEachFeature: function (feature, layer) {
                        layer.bindPopup('<strong>📍 ' + geoKecamatan.nama_kecamatan + '</strong>');
                    }
                }).addTo(map);
            } catch (e) {
                console.error('GeoJSON tidak valid: ' + geoKecamatan.nama_kecamatan);
            }
        }

        // ── Marker sekolah ──────────────────────────────────────────
        const marker = L.marker([lat, lng]).addTo(map);
        marker.bindPopup(`
            <div style="min-width:160px;">
                <strong><?= esc($sekolah['nama_sekolah']) ?></strong><br>
                <small><?= esc($sekolah['kecamatan'] ?? '') ?></small><br>
                <small><?= esc($sekolah['alamat'] ?? '') ?></small>
            </div>
        `).openPopup();
    <?php endif; ?>
</script>
</body>

</html>