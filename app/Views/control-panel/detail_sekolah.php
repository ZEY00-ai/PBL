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
    <link rel="icon" type="image/png" href="<?= base_url('logo/logo.ico') ?>" sizes="32x32" />
    <link rel="stylesheet" href="<?= base_url('assets/css/detailsekolah/style.css') ?>" />
    
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
                    $isNurulUmmah = ($sekolah['nama_sekolah'] === 'SD ISLAM TERPADU NURUL UMMAH TIGO JANGKO');
                    ?>
                    <span class="badge-tingkatan" style="background:<?= $tingkatanColor ?>;"><?= esc($sekolah['tingkatan'] ?? '-') ?></span>

                    <?php if (!empty($sekolah['akreditasi'])): ?>
                        <span class="badge-tingkatan">Akreditasi <?= esc($sekolah['akreditasi']) ?></span>
                    <?php endif; ?>

                    <?php if ($isNurulUmmah): ?>
                        <span class="badge-tingkatan" style="background:#0891b2;">Swasta</span>
                    <?php else: ?>
                        <span class="badge-tingkatan" style="background:#0891b2;">Negeri</span>
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
                    <span class="icon-box"><i class="fa-solid fa-building"></i></span>
                    <div>
                        <div class="info-label">Status</div>
                        <span class="info-value"><?= $isNurulUmmah ? 'Swasta' : 'Negeri' ?></span>
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
            const geoKecamatan = GEOJSON_DATA.find(function(item) {
                return item.nama_kecamatan === SEKOLAH_KECAMATAN;
            });

            if (geoKecamatan) {
                try {
                    const geoData = typeof geoKecamatan.geojson === 'string' ?
                        JSON.parse(geoKecamatan.geojson) :
                        geoKecamatan.geojson;

                    L.geoJSON(geoData, {
                        style: {
                            color: geoKecamatan.warna,
                            weight: 2,
                            fillColor: geoKecamatan.warna,
                            fillOpacity: 0.25,
                        },
                        onEachFeature: function(feature, layer) {
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