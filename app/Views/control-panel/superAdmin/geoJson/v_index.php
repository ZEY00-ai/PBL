<?php echo view('components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Data GeoJSON</h1>
                            <p class="subtitle">Daftar data wilayah kecamatan</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('superAdmin/geojson/create') ?>" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-plus"></i> Tambah GeoJSON
                            </a>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <section class="m-card" style="padding:20px;">
                        <div class="dt-toolbar">
                            <div class="dt-search">
                                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                <input type="search" id="dt-search-input" placeholder="Search any column…" aria-label="Search">
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
                                <tr class="text-center">
                                    <th data-sort="no" class="text-center">No</th>
                                    <th data-sort="kecamatan" class="text-center">Nama Kecamatan</th>
                                    <th data-sort="warna" class="text-center">Warna</th>
                                    <th data-sort="dibuat" class="text-center">Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dt-body">
                                <?php if (!empty($geojson)): ?>
                                    <?php foreach ($geojson as $i => $g): ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td class="text-center"><?= esc($g['nama_kecamatan']) ?></td>
                                            <td class="text-center">
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <div style="width:28px; height:28px; background:<?= esc($g['warna']) ?>; border-radius:6px;"></div>
                                                    <small style="font-family:monospace;"><?= esc($g['warna']) ?></small>
                                                </div>
                                            </td>
                                            <td class="text-center"><small><?= $g['created_at'] ?></small></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('superAdmin/geojson/edit/' . $g['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>
                                                <a href="<?= base_url('superAdmin/geojson/detail/' . $g['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-eye"></i> Detail
                                                </a>
                                                <a href="<?= base_url('superAdmin/geojson/hapus/' . $g['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px; color:red;"
                                                    onclick="return confirm('Yakin hapus data kecamatan <?= esc($g['nama_kecamatan']) ?>?')">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div id="dt-empty" class="empty-state" style="display:none;">
                            <span class="empty-state__icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <h3 class="empty-state__title">No results</h3>
                            <p class="empty-state__text">Try a different search term, or clear the filter.</p>
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
    <?php echo view('components/footer'); ?>
    <script src="<?= base_url('assets/js/list.js') ?>"></script>
</body>