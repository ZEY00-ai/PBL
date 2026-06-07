<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="page-header">
                        <div>
                            <h1>Kelola User</h1>
                            <p class="subtitle">Halaman manajemen pengguna untuk admin sistem</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p>Konten manajemen user belum tersedia. Tambahkan tabel atau formulir di sini.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="m-card" style="padding: 20px;">
                            <div class="dt-toolbar">
                                <div class="dt-search">
                                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                    <input type="search" id="dt-search-input" placeholder="Search any column…" aria-label="Search">
                                </div>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <label style="font-size: 12.5px; color: var(--m-text-muted); display: inline-flex; align-items: center; gap: 8px;">
                                        Show
                                        <select id="dt-page-size" class="form-select" style="width: 80px; height: 32px; padding: 0 24px 0 10px; font-size: 12.5px;">
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
                                        <th data-sort="name">Nama</th>
                                        <th data-sort="email">Email</th>
                                        <th data-sort="plan">Role</th>
                                        <th data-sort="signup">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dt-body"></tbody>
                            </table>

                            <div id="dt-empty" class="empty-state" style="display: none;">
                                <span class="empty-state__icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <h3 class="empty-state__title">No results</h3>
                                <p class="empty-state__text">Try a different search term, or clear the filter to show everything again.</p>
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
</body>

</html>