    <?php echo view('components/header'); ?>

    <body class="app">
        <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
        <div class="page-container">

            <?php echo view('components/sidebar'); ?>

            <main class="main-content" id="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <!-- Page Header -->
                        <div class="page-header">
                            <div>
                                <h1>Kelola User</h1>
                                <p class="subtitle">Daftar data User</p>
                            </div>
                            <div class="page-header__actions">
                                <a href="<?= base_url('superAdmin/user/create') ?>" class="m-btn m-btn--primary">
                                    <i class="fa-solid fa-plus"></i> Tambah User
                                </a>
                            </div>
                        </div>

                        <!-- Flash Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
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
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="dt-body">
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $i => $g): ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1 ?></td>
                                                <td class="text-center"><?= esc($g['nama']) ?></td>
                                                <td class="text-center"><?= esc($g['email']) ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $role = $g['role'];
                                                    $badgeClass = match ($role) {
                                                        'super_admin' => 'badge-role badge-role--admin',
                                                        'admin'       => 'badge-role badge-role--operator',
                                                        'user'        => 'badge-role badge-role--user',
                                                        default       => 'badge-role badge-role--default',
                                                    };
                                                    ?>
                                                    <span class="<?= $badgeClass ?>">
                                                        <?= esc($role) ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('superAdmin/user/edit/' . $g['id']) ?>"
                                                        class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </a>
                                                    <a href="<?= base_url('superAdmin/user/detail/' . $g['id']) ?>"
                                                        class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                        <i class="fa-solid fa-eye"></i> Detail
                                                    </a>
                                                    <!-- <a href="<?= base_url('superAdmin/user/hapus/' . $g['id']) ?>"
                                                        class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px; color:red;"
                                                        onclick="return confirm('Yakin hapus data user <?= esc($g['nama']) ?>?')">
                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                    </a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada data User.</td>
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

        <?php echo view('components/footer'); ?>
        <script src="<?= base_url('assets/js/list.js') ?>"></script>
        <style>
            .theme-switcher {
                display: none !important;
            }

            .dt-table th {
                white-space: nowrap;
            }
        </style>
    </body>

    </html>