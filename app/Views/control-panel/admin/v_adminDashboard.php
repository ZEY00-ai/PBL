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
                            <h1>Dashboard Admin</h1>
                            <p class="subtitle">Welcome back, Admin! <?= esc(session()->get('user_nama')) ?></p>
                        </div>
                    </div>

                    <!-- Stat Cards -->
                    <div class="row row-tight" style="margin-bottom:24px;">
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Sekolah</p>
                                    <span class="stat-card__icon stat-card__icon--c1">
                                        <i class="fa-solid fa-school"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalSekolah ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up"></i> Data terdaftar
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Kecamatan</p>
                                    <span class="stat-card__icon stat-card__icon--c2">
                                        <i class="fa-solid fa-map"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalKecamatan ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up"></i> Wilayah terdaftar
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total GeoJSON</p>
                                    <span class="stat-card__icon stat-card__icon--c3">
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalGeoJson ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up"></i> Wilayah dipetakan
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total Akun</p>
                                    <span class="stat-card__icon stat-card__icon--c4">
                                        <i class="fa-solid fa-users"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalAkun ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up"></i> Admin terdaftar
                                </p>
                            </article>
                        </div>
                    </div>

                    <div class="row row-tight">

                        <!-- Daftar Sekolah Terbaru -->
                        <div class="col-lg-8">
                            <section class="m-card" aria-labelledby="sekolah-title">
                                <header class="m-card__header">
                                    <div>
                                        <h2 class="m-card__title" id="sekolah-title">Sekolah Terbaru</h2>
                                        <p class="m-card__subtitle">Data sekolah yang baru ditambahkan</p>
                                    </div>
                                    <a href="<?= base_url('admin/sekolah') ?>" class="m-btn m-btn--ghost"
                                        style="height:30px; padding:0 10px; font-size:12.5px;">View all</a>
                                </header>
                                <ul class="project-list">
                                    <?php if (!empty($sekolahTerbaru)): ?>
                                        <?php foreach ($sekolahTerbaru as $s): ?>
                                            <li>
                                                <div>
                                                    <p class="project-list__title"><?= esc($s['nama_sekolah']) ?></p>
                                                    <span class="project-list__meta">
                                                        <?= esc($s['kecamatan']) ?> ·
                                                        <?= $s['npsn'] ? 'NPSN: ' . esc($s['npsn']) : 'NPSN: -' ?> ·
                                                        <span class="status--process">terdaftar</span>
                                                    </span>
                                                </div>
                                                <a href="<?= base_url('admin/sekolah/detail/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost"
                                                    style="height:28px; padding:0 10px; font-size:12px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li style="padding:16px; color:var(--m-text-muted); text-align:center;">
                                            Belum ada data sekolah.
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </section>
                        </div>

                        <!-- Sekolah per Kecamatan -->
                        <div class="col-lg-4">
                            <section class="m-card" aria-labelledby="kecamatan-title">
                                <header class="m-card__header">
                                    <div>
                                        <h2 class="m-card__title" id="kecamatan-title">Sekolah per Kecamatan</h2>
                                        <p class="m-card__subtitle">Jumlah sekolah tiap kecamatan</p>
                                    </div>
                                </header>
                                <div class="donut-wrap">
                                    <canvas id="chart-kecamatan"></canvas>
                                </div>
                                <ul style="list-style:none; padding:0; margin:12px 0 0;">
                                    <?php foreach ($sekolahPerKecamatan as $kec): ?>
                                        <li style="display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px solid var(--m-divider); font-size:13px;">
                                            <span><?= esc($kec['kecamatan']) ?></span>
                                            <strong><?= $kec['total'] ?></strong>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </section>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        // Chart sekolah per kecamatan
        const labels = <?= json_encode(array_column($sekolahPerKecamatan, 'kecamatan')) ?>;
        const values = <?= json_encode(array_column($sekolahPerKecamatan, 'total')) ?>;
        const colors = ['#4272d7', '#7c3aed', '#0d9488', '#e11d48', '#d97706', '#334155', '#06b6d4', '#84cc16', '#f43f5e', '#8b5cf6'];

        const ctx = document.getElementById('chart-kecamatan');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: colors.slice(0, labels.length),
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    </script>

    <?php echo view('control-panel/components/footer'); ?>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>