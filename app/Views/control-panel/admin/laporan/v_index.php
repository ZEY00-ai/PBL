<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('control-panel/components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Laporan Sekolah</h1>
                            <p class="subtitle">Data sekolah Kabupaten Tanah Datar</p>
                        </div>
                    </div>

                    <!-- Stat Cards -->
                    <div class="row row-tight" style="margin-bottom:20px;">
                        <div class="col-sm-4">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Sekolah</p>
                                    <span class="stat-card__icon stat-card__icon--c1">
                                        <i class="fa-solid fa-school"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= count($sekolah) ?></p>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Kecamatan</p>
                                    <span class="stat-card__icon stat-card__icon--c2">
                                        <i class="fa-solid fa-map"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= count($kecamatan) ?></p>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Wilayah GeoJSON</p>
                                    <span class="stat-card__icon stat-card__icon--c3">
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalGeoJson ?></p>
                            </article>
                        </div>
                    </div>

                    <!-- Filter & Export -->
                    <div class="m-card p-4" style="margin-bottom:20px;">
                        <h2 class="m-card__title" style="margin-bottom:16px;">Filter & Export</h2>
                        <form action="<?= base_url('laporan/export') ?>" method="get" id="form-export">
                            <div class="row row-tight">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="fw-semibold">Filter</label>
                                        <select name="filter" id="filter" class="form-select" onchange="toggleFilter()">
                                            <option value="">-- Semua Sekolah --</option>
                                            <option value="kecamatan">Per Kecamatan</option>
                                            <option value="sekolah">Per Sekolah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5" id="wrap-nilai">
                                    <!-- Filter Kecamatan -->
                                    <div id="filter-kecamatan" style="display:none;">
                                        <div class="form-group">
                                            <label class="fw-semibold">Pilih Kecamatan</label>
                                            <select name="nilai" class="form-select">
                                                <option value="">-- Pilih Kecamatan --</option>
                                                <?php foreach ($kecamatan as $k): ?>
                                                    <option value="<?= esc($k['kecamatan']) ?>">
                                                        <?= esc($k['kecamatan']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Filter Sekolah -->
                                    <div id="filter-sekolah" style="display:none;">
                                        <div class="form-group">
                                            <label class="fw-semibold">Pilih Sekolah</label>
                                            <select name="nilai" class="form-select">
                                                <option value="">-- Pilih Sekolah --</option>
                                                <?php foreach ($sekolah as $s): ?>
                                                    <option value="<?= $s['id'] ?>">
                                                        <?= esc($s['nama_sekolah']) ?> - <?= esc($s['kecamatan']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="display:flex; align-items:flex-end;">
                                    <button type="submit" class="m-btn m-btn--primary" style="width:100%;">
                                        <i class="fa-solid fa-file-pdf"></i> Export PDF
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Data -->
                    <section class="m-card" style="padding:20px;">
                        <div class="dt-toolbar">
                            <div class="dt-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="search" id="dt-search-input" placeholder="Search any column…">
                            </div>
                            <div style="display:flex; gap:8px; align-items:center;">
                                <label style="font-size:12.5px; color:var(--m-text-muted); display:inline-flex; align-items:center; gap:8px;">
                                    Show
                                    <select id="dt-page-size" class="form-select" style="width:80px; height:32px; padding:0 24px 0 10px; font-size:12.5px;">
                                        <option>5</option>
                                        <option selected>10</option>
                                        <option>20</option>
                                        <option>50</option>
                                    </select>
                                    rows
                                </label>
                            </div>
                        </div>

                        <table class="m-table dt-table" id="dt-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPSN</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <th>Tahun Berdiri</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dt-body">
                                <?php if (!empty($sekolah)): ?>
                                    <?php foreach ($sekolah as $i => $s): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $s['npsn'] ? esc($s['npsn']) : '-' ?></td>
                                            <td><?= esc($s['nama_sekolah']) ?></td>
                                            <td><?= esc($s['kecamatan']) ?></td>
                                            <td><?= esc($s['alamat']) ?></td>
                                            <td><?= $s['tahun_berdiri'] ?? '-' ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/sekolah/detail/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data sekolah.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div id="dt-empty" class="empty-state" style="display:none;">
                            <span class="empty-state__icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <h3 class="empty-state__title">No results</h3>
                            <p class="empty-state__text">Try a different search term.</p>
                            <div class="empty-state__actions">
                                <button type="button" class="m-btn m-btn--ghost" id="dt-clear-search">Clear search</button>
                            </div>
                        </div>

                        <div class="dt-pagination">
                            <span class="dt-pagination__info" id="dt-info"></span>
                            <div class="dt-pagination__nav" id="dt-nav"></div>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('control-panel/components/footer'); ?>
    <script src="<?= base_url('assets/js/laporan/index.js') ?>"></script>
    <script>
        function toggleFilter() {
            const filter = document.getElementById('filter').value;
            document.getElementById('filter-kecamatan').style.display = filter === 'kecamatan' ? 'block' : 'none';
            document.getElementById('filter-sekolah').style.display = filter === 'sekolah' ? 'block' : 'none';
        }
    </script>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>