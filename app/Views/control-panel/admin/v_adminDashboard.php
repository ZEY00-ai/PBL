<?php echo view('components/header'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<body class="app">
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

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
                                    <i class="fa-solid fa-arrow-up"></i> Semua tingkatan
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total TK</p>
                                    <span class="stat-card__icon stat-card__icon--c2">
                                        <i class="fa-solid fa-child"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalTK ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-circle" style="color:green; font-size:10px;"></i> Taman Kanak-Kanak
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total SD</p>
                                    <span class="stat-card__icon stat-card__icon--c3">
                                        <i class="fa-solid fa-book"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalSD ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-circle" style="color:red; font-size:10px;"></i> Sekolah Dasar
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Total SMP</p>
                                    <span class="stat-card__icon stat-card__icon--c4">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                                <p class="stat-card__value"><?= $totalSMP ?></p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-circle" style="color:navy; font-size:10px;"></i> Sekolah Menengah Pertama
                                </p>
                            </article>
                        </div>
                    </div>

                    <div class="row row-tight">

                        <!-- Peta -->
                        <div class="col-lg-8">
                            <section class="m-card" style="padding:0; overflow:hidden;">
                                <div style="padding:16px 20px; border-bottom:1px solid var(--m-divider);">
                                    <h2 class="m-card__title" style="margin:0;">Peta Sebaran Sekolah</h2>
                                    <p class="m-card__subtitle" style="margin:0;">Lokasi sekolah di Kabupaten Tanah Datar</p>
                                </div>
                                <div id="map" style="height:450px; width:100%;"></div>
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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // ── Peta ──────────────────────────────────────────────────────
        const map = L.map('map').setView([-0.4558, 100.6162], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // GeoJSON
        const geojsonData = <?= json_encode($geojson) ?>;
        geojsonData.forEach(function(item) {
            try {
                const geoData = JSON.parse(item.geojson);
                L.geoJSON(geoData, {
                    style: {
                        color: item.warna,
                        weight: 2,
                        fillColor: item.warna,
                        fillOpacity: 0.3,
                    }
                }).bindPopup('<strong>' + item.nama_kecamatan + '</strong>').addTo(map);
            } catch (e) {}
        });

        // Marker sekolah
        function getMarkerColor(tingkatan) {
            switch (tingkatan) {
                case 'TK':
                    return 'green';
                case 'SD':
                    return 'red';
                case 'SMP':
                    return 'navy';
                default:
                    return 'blue';
            }
        }

        function createIcon(color) {
            return L.divIcon({
                className: '',
                html: `<div style="width:20px;height:20px;background:${color};border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,0.3);"></div>`,
                iconSize: [20, 20],
                iconAnchor: [10, 20],
                popupAnchor: [0, -24],
            });
        }

        const sekolah = <?= json_encode($sekolah) ?>;
        sekolah.forEach(function(s) {
            if (s.latitude && s.longitude) {
                const color = getMarkerColor(s.tingkatan);
                L.marker([s.latitude, s.longitude], {
                        icon: createIcon(color)
                    })
                    .bindPopup(`
                    <div style="min-width:160px;">
                        ${s.foto ? `<img src="/uploads/sekolah/${s.foto}" style="width:100%;height:90px;object-fit:cover;border-radius:6px;margin-bottom:6px;">` : ''}
                        <strong>🏫 ${s.nama_sekolah}</strong><br>
                        <small>📍 ${s.kecamatan}</small><br>
                        <span style="display:inline-block;margin-top:4px;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:600;background:${color};color:#fff;">${s.tingkatan ?? '-'}</span>
                    </div>
                `)
                    .addTo(map);
            }
        });

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
                        borderWidth: 2
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

    <?php echo view('components/footer'); ?>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>