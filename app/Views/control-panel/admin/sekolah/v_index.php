<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('control-panel/components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h1>Data Sekolah</h1>
                            <p class="subtitle">Daftar seluruh sekolah di Kabupaten Tanah Datar</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('admin/sekolah/tambah') ?>" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-plus"></i> Tambah Sekolah
                            </a>
                        </div>
                    </div>

                    <!-- Flash Message -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <!-- Table Card -->
                    <section class="m-card" style="padding:20px;">

                        <!-- Toolbar -->
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
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Sekolah</th>
                                    <th class="text-center">Tingkatan</th>
                                    <th class="text-center">Akreditasi</th>
                                    <th class="text-center">Kecamatan</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="dt-body">
                                <?php if (!empty($sekolah)): ?>
                                    <?php foreach ($sekolah as $i => $s): ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>

                                            <td class="text-center"><?= esc($s['nama_sekolah']) ?></td>

                                            <td class="text-center">
                                                <?php if ($s['tingkatan']): ?>
                                                    <span style="display:inline-block; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; background:var(--m-accent-soft, #eef2ff); color:var(--m-accent);">
                                                        <?= esc($s['tingkatan']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if ($s['akreditasi']): ?>
                                                    <?php
                                                    $badgeColor = match ($s['akreditasi']) {
                                                        'A'    => '#16a34a',
                                                        'B'    => '#2563eb',
                                                        'C'    => '#d97706',
                                                        default => '#6b7280',
                                                    };
                                                    ?>
                                                    <span style="display:inline-block; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; background:<?= $badgeColor ?>; color:#fff;">
                                                        <?= esc($s['akreditasi']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center"><?= esc($s['kecamatan']) ?></td>

                                            <td class="col-alamat text-center" title="<?= esc($s['alamat']) ?>"><?= esc($s['alamat']) ?></td>

                                            <td class="text-center">
                                                <?php if ($s['foto']): ?>
                                                    <img src="<?= base_url('uploads/sekolah/' . $s['foto']) ?>"
                                                        width="100"
                                                        height="100"
                                                        style="object-fit:cover; border-radius:6px;"
                                                        alt="<?= esc($s['nama_sekolah']) ?>">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?= base_url('admin/sekolah/detail/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost"
                                                    style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-eye"></i> Detail
                                                </a>

                                                <a href="<?= base_url('admin/sekolah/edit/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost"
                                                    style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>

                                                <a href="<?= base_url('admin/sekolah/hapus/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost"
                                                    style="padding:4px 10px; font-size:12px; color:red;"
                                                    onclick="return confirm('Yakin hapus data <?= esc($s['nama_sekolah']) ?>?')">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Belum ada data sekolah.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Empty State (JS Search) -->
                        <div id="dt-empty" class="empty-state" style="display:none;">
                            <span class="empty-state__icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <h3 class="empty-state__title">No results</h3>
                            <p class="empty-state__text">Try a different search term, or clear the filter.</p>
                            <div class="empty-state__actions">
                                <button type="button" class="m-btn m-btn--ghost" id="dt-clear-search">Clear search</button>
                            </div>
                        </div>

                        <!-- Pagination -->
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
    <script src="<?= base_url('assets/js/list.js') ?>"></script>
    <style>
        .theme-switcher {
            display: none !important;
        }

        .dt-table th {
            white-space: nowrap;
        }

        .dt-table td.col-alamat {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: left;
        }

        .dt-table th:nth-child(6) {
            text-align: left;
        }

    </style>
</body>