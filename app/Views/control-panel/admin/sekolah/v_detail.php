<?php echo view('control-panel/components/header'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<body class="app">
    <div class="page-container">

        <?php echo view('control-panel/components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h1>Detail Sekolah</h1>
                            <p class="subtitle">Informasi lengkap data sekolah</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('admin/sekolah') ?>" class="m-btn m-btn--ghost">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                            <a href="<?= base_url('admin/sekolah/edit/' . $sekolah['id']) ?>" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                        </div>
                    </div>

                    <div class="row row-tight">

                        <!-- Kolom Kiri: Info + Foto -->
                        <div class="col-lg-5">

                            <!-- Foto Sekolah -->
                            <div class="m-card" style="padding:0; overflow:hidden; margin-bottom:16px;">
                                <?php if ($sekolah['foto']): ?>
                                    <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                                        alt="Foto <?= esc($sekolah['nama_sekolah']) ?>"
                                        style="width:100%; height:250px; object-fit:cover;">
                                <?php else: ?>
                                    <div style="width:100%; height:250px; background:#f4f6fa; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:8px; color:#aaa;">
                                        <i class="fa-solid fa-image" style="font-size:48px;"></i>
                                        <span>Foto tidak tersedia</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Info Sekolah -->
                            <div class="m-card">
                                <div class="m-card__header">
                                    <div>
                                        <h2 class="m-card__title">Informasi Sekolah</h2>
                                    </div>
                                </div>
                                <table style="width:100%; border-collapse:collapse;">
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted); width:40%;">
                                            <i class="fa-solid fa-school"></i> Nama
                                        </td>
                                        <td style="padding:10px 0; font-weight:600;">
                                            <?= esc($sekolah['nama_sekolah']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-hashtag"></i> NPSN
                                        </td>
                                        <td style="padding:10px 0;">
                                            <?= $sekolah['npsn'] ? esc($sekolah['npsn']) : '<span class="text-muted">-</span>' ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-map"></i> Kecamatan
                                        </td>
                                        <td style="padding:10px 0;">
                                            <?= esc($sekolah['kecamatan']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-location-dot"></i> Alamat
                                        </td>
                                        <td style="padding:10px 0;">
                                            <?= esc($sekolah['alamat']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-calendar"></i> Tahun Berdiri
                                        </td>
                                        <td style="padding:10px 0;">
                                            <?= $sekolah['tahun_berdiri'] ? esc($sekolah['tahun_berdiri']) : '<span class="text-muted">-</span>' ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-globe"></i> Website
                                        </td>
                                        <td style="padding:10px 0;">
                                            <?php if ($sekolah['website']): ?>
                                                <a href="<?= esc($sekolah['website']) ?>" target="_blank" style="color:var(--m-accent);">
                                                    <?= esc($sekolah['website']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-crosshairs"></i> Latitude
                                        </td>
                                        <td style="padding:10px 0; font-family:monospace;">
                                            <?= $sekolah['latitude'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-crosshairs"></i> Longitude
                                        </td>
                                        <td style="padding:10px 0; font-family:monospace;">
                                            <?= $sekolah['longitude'] ?>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Tombol Google Maps -->
                                <div style="margin-top:16px;">
                                    <a href="https://www.google.com/maps?q=<?= $sekolah['latitude'] ?>,<?= $sekolah['longitude'] ?>"
                                        target="_blank" class="m-btn m-btn--ghost" style="width:100%; justify-content:center;">
                                        <i class="fa-brands fa-google"></i> Buka di Google Maps
                                    </a>
                                </div>
                            </div>

                        </div>

                        <!-- Kolom Kanan: Peta -->
                        <div class="col-lg-7">
                            <div class="m-card" style="padding:0; overflow:hidden; height:100%;">
                                <div style="padding:16px 20px; border-bottom:1px solid var(--m-divider);">
                                    <h2 class="m-card__title" style="margin:0;">Lokasi di Peta</h2>
                                </div>
                                <div id="map" style="height:540px; width:100%;"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const lat = <?= $sekolah['latitude'] ?>;
        const lng = <?= $sekolah['longitude'] ?>;

        const map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([lat, lng]).addTo(map);
        marker.bindPopup(`
            <div style="min-width:160px;">
                ${<?= json_encode($sekolah['foto']) ?> 
                    ? `<img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>" style="width:100%; height:90px; object-fit:cover; border-radius:6px; margin-bottom:6px;">` 
                    : ''
                }
                <strong>🏫 <?= esc($sekolah['nama_sekolah']) ?></strong><br>
                <?php if ($sekolah['npsn']): ?>
                    <small>NPSN: <?= esc($sekolah['npsn']) ?></small><br>
                <?php endif; ?>
                <small><?= esc($sekolah['kecamatan']) ?></small><br>
                <small><?= esc($sekolah['alamat']) ?></small>
                <?php if ($sekolah['website']): ?>
                    <br><a href="<?= esc($sekolah['website']) ?>" target="_blank" style="font-size:11px;">🌐 Website</a>
                <?php endif; ?>
            </div>
        `).openPopup();
    </script>

    <?php echo view('control-panel/components/footer'); ?>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>