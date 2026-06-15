<?php echo view('control-panel/components/header'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<body class="app">
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h1>Detail Kecamatan</h1>
                            <p class="subtitle">Informasi wilayah dan sekolah di kecamatan ini</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('operator-maps/geojson/list') ?>" class="m-btn m-btn--ghost">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                            <a href="<?= base_url('operator-maps/geojson/edit/' . $geojson['id']) ?>" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                        </div>
                    </div>

                    <div class="row row-tight">

                        <!-- Kolom Kiri: Info Kecamatan + Daftar Sekolah -->
                        <div class="col-lg-4">

                            <!-- Info Kecamatan -->
                            <div class="m-card" style="margin-bottom:16px;">
                                <div class="m-card__header">
                                    <h2 class="m-card__title">Informasi Wilayah</h2>
                                </div>
                                <table style="width:100%; border-collapse:collapse;">
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted); width:45%;">
                                            <i class="fa-solid fa-map"></i> Kecamatan
                                        </td>
                                        <td style="padding:10px 0; font-weight:600;">
                                            <?= esc($geojson['nama_kecamatan']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-palette"></i> Warna
                                        </td>
                                        <td style="padding:10px 0;">
                                            <div style="display:flex; align-items:center; gap:8px;">
                                                <div style="width:24px; height:24px; background:<?= esc($geojson['warna']) ?>; border-radius:4px;"></div>
                                                <span style="font-family:monospace;"><?= esc($geojson['warna']) ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-school"></i> Jumlah Sekolah
                                        </td>
                                        <td style="padding:10px 0; font-weight:600;">
                                            <?= count($sekolah) ?> sekolah
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-calendar"></i> Ditambahkan
                                        </td>
                                        <td style="padding:10px 0;">
                                            <small><?= $geojson['created_at'] ?></small>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Daftar Sekolah -->
                            <div class="m-card">
                                <div class="m-card__header">
                                    <h2 class="m-card__title">Daftar Sekolah</h2>
                                </div>
                                <?php if (!empty($sekolah)): ?>
                                    <ul style="list-style:none; padding:0; margin:0;">
                                        <?php foreach ($sekolah as $s): ?>
                                            <li style="padding:10px 0; border-bottom:1px solid var(--m-divider);">
                                                <div style="display:flex; align-items:center; gap:10px;">
                                                    <?php if ($s['foto']): ?>
                                                        <img src="<?= base_url('uploads/sekolah/' . $s['foto']) ?>"
                                                            style="width:44px; height:44px; object-fit:cover; border-radius:8px;">
                                                    <?php else: ?>
                                                        <div style="width:44px; height:44px; background:#f4f6fa; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#aaa;">
                                                            <i class="fa-solid fa-school"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div style="font-weight:600; font-size:13px;">
                                                            <?= esc($s['nama_sekolah']) ?>
                                                        </div>
                                                        <small style="color:var(--m-text-muted);">
                                                            <?= esc($s['alamat']) ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div style="text-align:center; padding:24px; color:var(--m-text-muted);">
                                        <i class="fa-solid fa-school" style="font-size:32px; margin-bottom:8px; display:block;"></i>
                                        Belum ada sekolah di kecamatan ini.
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>

                        <!-- Kolom Kanan: Peta -->
                        <div class="col-lg-8">
                            <div class="m-card" style="padding:0; overflow:hidden;">
                                <div style="padding:16px 20px; border-bottom:1px solid var(--m-divider);">
                                    <h2 class="m-card__title" style="margin:0;">Peta Wilayah</h2>
                                </div>
                                <div id="map" style="height:580px; width:100%;"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-0.4558, 100.6162], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tampilkan GeoJSON wilayah kecamatan
        const geojsonRaw = <?= json_encode($geojson['geojson']) ?>;
        try {
            const geoData = JSON.parse(geojsonRaw);
            const layer = L.geoJSON(geoData, {
                style: {
                    color: '<?= $geojson['warna'] ?>',
                    weight: 2,
                    fillColor: '<?= $geojson['warna'] ?>',
                    fillOpacity: 0.3,
                }
            }).addTo(map);

            // Auto zoom ke wilayah
            map.fitBounds(layer.getBounds());
        } catch (e) {
            console.error('GeoJSON tidak valid.');
        }

        // Marker sekolah
        const sekolah = <?= json_encode($sekolah) ?>;
        sekolah.forEach(function(s) {
            if (s.latitude && s.longitude) {
                L.marker([s.latitude, s.longitude])
                    .bindPopup(`
                    <div style="min-width:160px;">
                        ${s.foto
                            ? `<img src="/uploads/sekolah/${s.foto}" style="width:100%; height:90px; object-fit:cover; border-radius:6px; margin-bottom:6px;">`
                            : ''
                        }
                        <strong>🏫 ${s.nama_sekolah}</strong><br>
                        <small>${s.alamat}</small>
                    </div>
                `)
                    .addTo(map);
            }
        });
    </script>

    <?php echo view('control-panel/components/footer'); ?>
</body>