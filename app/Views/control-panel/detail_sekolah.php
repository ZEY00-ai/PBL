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
            <a href="<?= esc($backUrl ?? base_url('/')) ?>" class="btn btn-outline-primary btn-sm mb-3">
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

        <!-- Visi & Misi -->
        <div class="row g-3 section-gap">

            <!-- Visi -->
            <div class="col-md-6">
                <div class="card-box h-100">
                    <h5><i class="fa-solid fa-eye"></i> Visi</h5>
                    <?php if (!empty($sekolah['visi'])): ?>
                        <p class="visi-misi"><?= nl2br(esc($sekolah['visi'])) ?></p>
                    <?php else: ?>
                        <p class="visi-misi empty">Belum Terisi</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Misi -->
            <div class="col-md-6">
                <div class="card-box h-100">
                    <h5><i class="fa-solid fa-bullseye"></i> Misi</h5>
                    <?php if (!empty($sekolah['misi'])): ?>
                        <?php
                        // Pecah misi jadi array per baris/poin, buang baris kosong
                        $misiItems = preg_split('/\r\n|\r|\n/', trim($sekolah['misi']));
                        $misiItems = array_filter(array_map('trim', $misiItems), function ($item) {
                            return $item !== '';
                        });
                        ?>
                        <?php if (count($misiItems) > 1): ?>
                            <ol class="misi-list">
                                <?php foreach ($misiItems as $item): ?>
                                    <li><?= esc(preg_replace('/^\d+[\.\)]\s*/', '', $item)) ?></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php else: ?>
                            <p class="visi-misi"><?= nl2br(esc($sekolah['misi'])) ?></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="visi-misi empty">Belum Terisi</p>
                    <?php endif; ?>
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

    </div>

    <!-- Footer -->
    <!-- <footer class="site-footer mt-2">
        <div class="container">
            <div class="row align-items-center g-2">
                <div class="col-12 col-md-6">
                    <p class="mb-0 fw-semibold footer-title">
                        <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                        SIG Pemetaan Sekolah Kabupaten Tanah Datar
                    </p>
                </div>
            </div>
        </div>
    </footer> -->

    <script src="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.bundle.min.js') ?>"></script>
    <script>
        const GEOJSON_DATA = <?= json_encode($geojson ?? []) ?>;
        const SEKOLAH_KECAMATAN = <?= json_encode($sekolah['kecamatan'] ?? '') ?>;

        // ═══════════════════════════════════════════════════
        // 🔧 SWITCH MODE MARKER: ganti true/false buat pindah mode
        // true  = pakai marker gambar PNG
        // false = pakai marker default Leaflet (pin biru bawaan)
        // ═══════════════════════════════════════════════════
        const USE_IMAGE_MARKER = true;

        // MARKER GAMBAR: base URL folder file PNG marker
        const MARKER_BASE_URL = '<?= base_url('assets/markers') ?>';

        // MARKER GAMBAR: pilih file PNG sesuai tingkatan sekolah
        function getMarkerIconUrl(tingkatan) {
            switch (tingkatan) {
                case 'TK':
                    return `${MARKER_BASE_URL}/1.png`;
                case 'SD':
                    return `${MARKER_BASE_URL}/1.png`;
                case 'SMP':
                    return `${MARKER_BASE_URL}/marker-smp.png`;
                default:
                    return `${MARKER_BASE_URL}/marker-default.png`;
            }
        }

        // createIcon otomatis pilih mode sesuai USE_IMAGE_MARKER di atas
        // kalau false, return null → biar L.marker() pakai icon default bawaan Leaflet
        function createIcon(tingkatan) {
            if (USE_IMAGE_MARKER) {
                return L.icon({
                    iconUrl: getMarkerIconUrl(tingkatan),
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32],
                });
            } else {
                return null; // null = pakai default marker Leaflet
            }
        }

        <?php if ($sekolah['latitude'] && $sekolah['longitude']): ?>
            const lat = <?= $sekolah['latitude'] ?>;
            const lng = <?= $sekolah['longitude'] ?>;
            const tingkatanSekolah = <?= json_encode($sekolah['tingkatan'] ?? '') ?>; // MARKER GAMBAR: dipakai buat pilih PNG

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
            const markerIcon = createIcon(tingkatanSekolah); // MARKER GAMBAR: otomatis ikut USE_IMAGE_MARKER

            const marker = markerIcon ?
                L.marker([lat, lng], {
                    icon: markerIcon
                }).addTo(map) // mode gambar
                :
                L.marker([lat, lng]).addTo(map); // mode default Leaflet

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