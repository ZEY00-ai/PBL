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
                            <h1>Peta Sekolah</h1>
                            <p class="subtitle">Sebaran sekolah di Kabupaten Tanah Datar</p>
                        </div>
                    </div>

                    <div class="m-card" style="padding:0; overflow:hidden;">
                        <div id="map" style="height:550px; width:100%;"></div>
                    </div>

                    <!-- Legenda -->
                    <div class="m-card" style="margin-top:16px; padding:20px;">
                        <h2 class="m-card__title" style="margin-bottom:16px;">Legenda</h2>
                        <div style="display:flex; gap:40px; flex-wrap:wrap;">

                            <!-- Tingkatan -->
                            <div>
                                <p style="font-size:11px; color:var(--m-text-muted); margin-bottom:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">Tingkatan Sekolah</p>
                                <div style="display:flex; flex-direction:column; gap:8px;">
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div style="width:14px; height:14px; background:green; border-radius:50%; border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,0.3);"></div>
                                        <span style="font-size:13px;">TK</span>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div style="width:14px; height:14px; background:red; border-radius:50%; border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,0.3);"></div>
                                        <span style="font-size:13px;">SD</span>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div style="width:14px; height:14px; background:navy; border-radius:50%; border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,0.3);"></div>
                                        <span style="font-size:13px;">SMP</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Akreditasi -->
                            <div>
                                <p style="font-size:11px; color:var(--m-text-muted); margin-bottom:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">Akreditasi</p>
                                <div style="display:flex; flex-direction:column; gap:8px;">
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span style="display:inline-block; padding:1px 10px; border-radius:10px; font-size:11px; font-weight:700; background:#16a34a; color:#fff;">A</span>
                                        <span style="font-size:13px;">Sangat Baik</span>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span style="display:inline-block; padding:1px 10px; border-radius:10px; font-size:11px; font-weight:700; background:#2563eb; color:#fff;">B</span>
                                        <span style="font-size:13px;">Baik</span>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span style="display:inline-block; padding:1px 10px; border-radius:10px; font-size:11px; font-weight:700; background:#d97706; color:#fff;">C</span>
                                        <span style="font-size:13px;">Cukup</span>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span style="display:inline-block; padding:1px 10px; border-radius:10px; font-size:11px; font-weight:700; background:#6b7280; color:#fff;">-</span>
                                        <span style="font-size:13px;">Belum Terakreditasi</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kecamatan -->
                            <?php if (!empty($geojson)): ?>
                                <div>
                                    <p style="font-size:11px; color:var(--m-text-muted); margin-bottom:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">Wilayah Kecamatan</p>
                                    <div style="display:flex; flex-wrap:wrap; gap:10px;">
                                        <?php foreach ($geojson as $g): ?>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <div style="width:14px; height:14px; background:<?= esc($g['warna']) ?>; border-radius:4px; opacity:0.7;"></div>
                                                <span style="font-size:13px;"><?= esc($g['nama_kecamatan']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-0.4558, 100.6162], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // ── GeoJSON Kecamatan ─────────────────────────────────────
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
                    },
                    onEachFeature: function(feature, layer) {
                        layer.on('click', function() {
                            layer.bindPopup('<strong>📍 ' + item.nama_kecamatan + '</strong>').openPopup();
                        });
                        layer.on('mouseover', function() {
                            layer.setStyle({
                                fillOpacity: 0.6
                            });
                        });
                        layer.on('mouseout', function() {
                            layer.setStyle({
                                fillOpacity: 0.3
                            });
                        });
                    }
                }).addTo(map);
            } catch (e) {
                console.error('GeoJSON tidak valid: ' + item.nama_kecamatan);
            }
        });

        // ── Marker Sekolah ────────────────────────────────────────
        const sekolah = <?= json_encode($sekolah) ?>;

        function getMarkerColor(tingkatan) {
            switch (tingkatan) {
                case 'TK':
                    return 'green';
                case 'SD':
                    return 'red';
                case 'SMP':
                    return 'navy';
                default:
                    return 'gray';
            }
        }

        function getAkreditasiColor(akreditasi) {
            switch (akreditasi) {
                case 'A':
                    return '#16a34a';
                case 'B':
                    return '#2563eb';
                case 'C':
                    return '#d97706';
                default:
                    return '#6b7280';
            }
        }

        function createIcon(color) {
            return L.divIcon({
                className: '',
                html: `<div style="
                    width:24px; height:24px;
                    background:${color};
                    border-radius:50% 50% 50% 0;
                    transform:rotate(-45deg);
                    border:3px solid #fff;
                    box-shadow:0 2px 8px rgba(0,0,0,0.3);
                "></div>`,
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -28],
            });
        }

        sekolah.forEach(function(s) {
            if (s.latitude && s.longitude) {
                const color = getMarkerColor(s.tingkatan);
                const akrColor = getAkreditasiColor(s.akreditasi);
                const akrLabel = s.akreditasi ?? 'Belum Terakreditasi';

                L.marker([s.latitude, s.longitude], {
                        icon: createIcon(color)
                    })
                    .bindPopup(`
                        <div style="min-width:190px;">
                            ${s.foto
                                ? `<img src="/uploads/sekolah/${s.foto}" style="width:100%; height:100px; object-fit:cover; border-radius:6px; margin-bottom:8px;">`
                                : ''
                            }
                            <strong style="font-size:13px;">🏫 ${s.nama_sekolah}</strong><br>
                            ${s.npsn ? `<small style="color:#888;">NPSN: ${s.npsn}</small><br>` : ''}
                            <small>📍 ${s.kecamatan}</small><br>
                            <small>${s.alamat}</small><br>
                            <div style="display:flex; gap:6px; margin-top:6px; flex-wrap:wrap;">
                                <span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:${color}; color:#fff;">
                                    ${s.tingkatan ?? '-'}
                                </span>
                                <span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:${akrColor}; color:#fff;">
                                    Akreditasi ${akrLabel}
                                </span>
                            </div>
                        </div>
                    `)
                    .addTo(map);
            }
        });
    </script>

    <?php echo view('components/footer'); ?>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>