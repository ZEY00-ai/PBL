<?php echo view('components/header'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<body class="app">
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-1 text-dark fw-bold">Profil Sekolah</h1>
                        </div>
                        <a href="<?= site_url('admin/profileSekolah/edit/' . $sekolah['id']) ?>" class="btn btn-primary d-flex align-items-center gap-2 px-3" style="border-radius: 8px;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Profil Sekolah
                        </a>
                    </div>

                    <!-- Informasi Sekolah (termasuk Kontak Sekolah, dibagi 2 kolom) -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <section class="card border-0 shadow-sm h-100 sekolah-info-card">
                                <div class="card-header-custom">
                                    <h5 class="fw-bold text-dark mb-0">
                                        <i class="fa-solid fa-school me-2 text-primary"></i>
                                        Informasi Sekolah
                                    </h5>
                                </div>

                                <div class="p-4">
                                    <div class="row g-4">

                                        <!-- Foto Sekolah -->
                                        <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-start">
                                            <div class="foto-sekolah-box">
                                                <?php if (!empty($sekolah['foto'])): ?>
                                                    <img src="<?= base_url('uploads/sekolah/' . esc($sekolah['foto'])) ?>" alt="Foto Sekolah">
                                                <?php else: ?>
                                                    <img src="<?= base_url('default/sekolah.png') ?>" alt="Foto Sekolah">
                                                <?php endif; ?>
                                            </div>

                                            <?php
                                            $akreditasi = $sekolah['akreditasi'] ?? null;
                                            $badgeClass = match ($akreditasi) {
                                                'A' => 'bg-success-subtle text-success border-success-subtle',
                                                'B' => 'bg-primary-subtle text-primary border-primary-subtle',
                                                'C' => 'bg-warning-subtle text-warning border-warning-subtle',
                                                default => 'bg-secondary-subtle text-secondary border-secondary-subtle',
                                            };
                                            ?>
                                            <?php if ($akreditasi): ?>
                                                <span class="badge <?= $badgeClass ?> border px-3 py-2 mt-3" style="font-size: 12.5px; border-radius: 8px; font-weight: 600;">
                                                    <i class="fa-solid fa-star me-1"></i> Akreditasi <?= esc($akreditasi) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Detail Info: dibagi 2 kolom -->
                                        <div class="col-md-8">
                                            <div class="row g-0">

                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <div class="info-list info-list--split">

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-building-columns"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Nama Sekolah</div>
                                                                <div class="info-value fw-semibold"><?= esc($sekolah['nama_sekolah'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-hashtag"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">NPSN</div>
                                                                <div class="info-value"><?= esc($sekolah['npsn'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-user-tie"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Kepala Sekolah</div>
                                                                <div class="info-value"><?= esc($sekolah['kepala_sekolah'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-layer-group"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Jenjang Pendidikan</div>
                                                                <div class="info-value"><?= esc($sekolah['tingkatan'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-map"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Kecamatan</div>
                                                                <div class="info-value"><?= esc($sekolah['kecamatan'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Kolom Kanan -->
                                                <div class="col-md-6">
                                                    <div class="info-list info-list--split">

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Nomor Sekolah</div>
                                                                <div class="info-value"><?= esc($sekolah['nomor_sekolah'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Email</div>
                                                                <div class="info-value"><?= esc($sekolah['email'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="info-row">
                                                            <div class="info-icon"><i class="fa-solid fa-globe"></i></div>
                                                            <div class="info-body">
                                                                <div class="info-label">Website</div>
                                                                <div class="info-value"><?= esc($sekolah['website'] ?? '-') ?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Alamat: full width di bawah kedua kolom -->
                                                <div class="col-12">
                                                    <div class="info-row border-0 pt-3">
                                                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                                                        <div class="info-body">
                                                            <div class="info-label">Alamat</div>
                                                            <div class="info-value"><?= esc($sekolah['alamat'] ?? '-') ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Visi & Misi (full width) -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <section class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #ffffff;">
                                <div class="border-bottom pb-2 mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold text-dark mb-0" style="border-left: 4px solid #3b82f6; padding-left: 10px;">Visi & Misi</h5>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-dark mb-2">Visi</h6>
                                        <p class="text-muted"><?= esc($sekolah['visi'] ?? '-') ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-dark mb-2">Misi</h6>

                                        <?php
                                        $misiRaw = trim($sekolah['misi'] ?? '');

                                        if ($misiRaw === '') {
                                            echo '<p class="text-muted">-</p>';
                                        } else {
                                            // Pecah string berdasarkan pola "angka." (misal "1.", "2.", dst)
                                            $misiItems = preg_split('/\d+\.\s*/', $misiRaw, -1, PREG_SPLIT_NO_EMPTY);
                                            $misiItems = array_map('trim', $misiItems);
                                        }
                                        ?>

                                        <?php if (!empty($misiItems)): ?>
                                            <ol class="text-muted ps-3 mb-0">
                                                <?php foreach ($misiItems as $item): ?>
                                                    <li class="mb-2"><?= esc($item) ?></li>
                                                <?php endforeach; ?>
                                            </ol>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <section class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #ffffff;">
                                <div class="border-bottom pb-2 mb-4">
                                    <h5 class="fw-bold text-dark mb-0" style="border-left: 4px solid #3b82f6; padding-left: 10px;">Informasi Tambahan</h5>
                                </div>

                                <div class="row g-4 row-cols-2 row-cols-sm-3 row-cols-md-3 text-center text-sm-start">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                        <div class="p-2 bg-primary-subtle text-primary rounded" style="width: 42px; height: 42px; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-map-pin fa-lg"></i></div>
                                        <div>
                                            <p class="text-muted small mb-0">Koordinat</p>
                                            <span class="fw-bold text-dark" style="font-size:14px;">
                                                <?= !empty($sekolah['latitude']) && !empty($sekolah['longitude'])
                                                    ? esc($sekolah['latitude']) . ', ' . esc($sekolah['longitude'])
                                                    : '-' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                        <div class="p-2 bg-success-subtle text-success rounded" style="width: 42px; height: 42px; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-clock-rotate-left fa-lg"></i></div>
                                        <div>
                                            <p class="text-muted small mb-0">Terakhir Diperbarui</p>
                                            <span class="fw-bold text-dark" style="font-size:14px;">
                                                <?= !empty($sekolah['updated_at'])
                                                    ? date('d M Y, H:i', strtotime($sekolah['updated_at']))
                                                    : '-' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                        <div class="p-2 bg-info-subtle text-info rounded" style="width: 42px; height: 42px; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-calendar-plus fa-lg"></i></div>
                                        <div>
                                            <p class="text-muted small mb-0">Terdaftar Sejak</p>
                                            <span class="fw-bold text-dark" style="font-size:14px;">
                                                <?= !empty($sekolah['created_at'])
                                                    ? date('d M Y', strtotime($sekolah['created_at']))
                                                    : '-' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php echo view('components/footer'); ?>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <?php if (!empty($sekolah['latitude']) && !empty($sekolah['longitude'])): ?>
        <script>
            const mapSekolah = L.map('map-sekolah', {
                zoomControl: true
            }).setView([<?= esc($sekolah['latitude']) ?>, <?= esc($sekolah['longitude']) ?>], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(mapSekolah);

            L.marker([<?= esc($sekolah['latitude']) ?>, <?= esc($sekolah['longitude']) ?>])
                .addTo(mapSekolah)
                .bindPopup('<?= esc($sekolah['nama_sekolah'] ?? 'Lokasi Sekolah') ?>')
                .openPopup();
        </script>
    <?php endif; ?>

    <style>
        .sekolah-info-card {
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid #eef1f6;
            background: #fafbfd;
        }

        .card-header-custom h5 {
            font-size: 15px;
        }

        .foto-sekolah-box {
            width: 100%;
            max-width: 180px;
            aspect-ratio: 1/1;
            border-radius: 14px;
            overflow: hidden;
            background: #f4f7fb;
            border: 1px solid #eef1f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .foto-sekolah-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-list {
            display: flex;
            flex-direction: column;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #eff6ff;
            color: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .info-body {
            min-width: 0;
        }

        .info-label {
            font-size: 11.5px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 14px;
            color: #1e293b;
            line-height: 1.5;
            word-break: break-word;
        }

        .info-list--split .info-row:last-child {
            border-bottom: none;
        }

        @media (min-width: 768px) {
            .col-md-6:first-child .info-list--split {
                padding-right: 20px;
            }

            .col-md-6:last-child .info-list--split {
                padding-left: 20px;
                border-left: 1px solid #f1f5f9;
            }
        }
    </style>
</body>