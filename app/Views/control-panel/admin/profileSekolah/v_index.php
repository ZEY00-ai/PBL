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
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb small mb-0" style="background: none; padding: 0;">
                                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profil Sekolah</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="<?= site_url('admin/profileSekolah/edit/' . $sekolah['id']) ?>" class="btn btn-primary d-flex align-items-center gap-2 px-3" style="border-radius: 8px;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Profil Sekolah
                        </a>
                    </div>

                    <div class="row g-4 mb-4">

                        <div class="col-lg-7 col-xl-12">
                            <section class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #ffffff;">
                                <div class="border-bottom pb-2 mb-4">
                                    <h5 class="fw-bold text-dark mb-0" style="border-left: 4px solid #3b82f6; padding-left: 10px;">Informasi Sekolah</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-start">
                                        <div class="p-3 bg-light rounded mb-3 d-flex align-items-center justify-content-center" style="width: 100%; max-width: 180px; aspect-ratio: 1/1;">
                                            <?php if (!empty($sekolah['foto'])): ?>
                                                <img src="<?= base_url('uploads/sekolah/' . esc($sekolah['foto'])) ?>" alt="Foto Sekolah" class="img-fluid" style="max-height: 140px;">
                                            <?php else: ?>
                                                <img src="<?= base_url('uploads/logo/default-school.png') ?>" alt="Foto Sekolah" class="img-fluid" style="max-height: 140px;">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless mb-0 align-middle" style="font-size: 14px;">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-muted py-2" style="width: 35%;">Nama Sekolah</td>
                                                        <td class="fw-semibold text-dark py-2"><?= esc($sekolah['nama_sekolah'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">NPSN</td>
                                                        <td class="text-dark py-2"><?= esc($sekolah['npsn'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">Kepala Sekolah</td>
                                                        <td class="text-dark py-2"><?= esc($sekolah['kepala_sekolah'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">Jenjang Pendidikan</td>
                                                        <td class="text-dark py-2"><?= esc($sekolah['tingkatan'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">Akreditasi</td>
                                                        <td class="py-2">
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
                                                                <span class="badge <?= $badgeClass ?> border px-2 py-1" style="font-size: 12px; border-radius: 4px;"><?= esc($akreditasi) ?></span>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">Kecamatan</td>
                                                        <td class="text-dark py-2"><?= esc($sekolah['kecamatan'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #f1f5f9;">
                                                        <td class="text-muted py-2">Alamat</td>
                                                        <td class="text-dark py-2"><?= esc($sekolah['alamat'] ?? '-') ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-7 col-xl-8 d-flex flex-column gap-4">
                            <section class="card border-0 shadow-sm p-4 flex-fill" style="border-radius: 12px; background: #ffffff;">
                                <div class="border-bottom pb-2 mb-3">
                                    <h5 class="fw-bold text-dark mb-0" style="border-left: 4px solid #3b82f6; padding-left: 10px;">Kontak Sekolah</h5>
                                </div>
                                <div class="row g-2" style="font-size: 14px;">
                                    <div class="col-12 d-flex align-items-center gap-3 py-1">
                                        <i class="fa-solid fa-phone text-muted" style="width: 20px;"></i>
                                        <span class="text-muted" style="width: 120px;">Nomor Sekolah</span>
                                        <span class="text-dark fw-medium"><?= esc($sekolah['nomor_sekolah'] ?? '-') ?></span>
                                    </div>
                                    <div class="col-12 d-flex align-items-center gap-3 py-1">
                                        <i class="fa-solid fa-envelope text-muted" style="width: 20px;"></i>
                                        <span class="text-muted" style="width: 120px;">Email</span>
                                        <span class="text-primary fw-medium"><?= esc($sekolah['email'] ?? '-') ?></span>
                                    </div>
                                    <div class="col-12 d-flex align-items-center gap-3 py-1">
                                        <i class="fa-solid fa-globe text-muted" style="width: 20px;"></i>
                                        <span class="text-muted" style="width: 120px;">Website</span>
                                        <span class="text-primary fw-medium"><?= esc($sekolah['website'] ?? '-') ?></span>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-5 col-xl-4 d-flex flex-column gap-4">
                            <section class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #ffffff;">
                                <div class="border-bottom pb-2 mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold text-dark mb-0" style="border-left: 4px solid #3b82f6; padding-left: 10px;">VIsi & Misi</h5>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h6 class="fw-bold text-dark mb-2">Visi</h6>
                                        <p class="text-muted"><?= esc($sekolah['visi'] ?? '-') ?></p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="fw-bold text-dark mb-2">Misi</h6>
                                        <p class="text-muted"><?= esc($sekolah['misi'] ?? '-') ?></p>
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
</body>