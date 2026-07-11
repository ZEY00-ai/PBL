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
                        <!-- FIX: height dinaikkan jadi 650px karena map ini full width (beda dgn dashboard yg cuma col-lg-8), biar rasio visual proporsional -->
                        <div id="map" style="height:650px; width:100%;"></div>
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
                                <!-- <p style="font-size:11px; color:var(--m-text-muted); margin-bottom:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">Akreditasi</p>
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
                                </div> -->
                            </div>

                            <!-- Kecamatan -->
                            <?php if (!empty($geojson)): ?>
                                <div class="map-legend__group">
                                    <p style="margin:0 0 4px 0;">Wilayah Kecamatan</p>
                                    <div style="display:flex; flex-direction:column; flex-wrap:wrap; height:90px; gap:4px 16px;">
                                        <?php foreach ($geojson as $g): ?>
                                            <div class="map-legend__item" style="display:flex; align-items:center; gap:6px;">
                                                <span style="width:14px; height:14px; border-radius:4px; background:<?= esc($g['warna']) ?>; opacity:0.7; display:inline-block; flex-shrink:0;"></span>
                                                <span style="font-size:13px; white-space:nowrap;"><?= esc($g['nama_kecamatan']) ?></span>
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
        // ── Base URL untuk foto sekolah ──
        const FOTO_BASE_URL = '<?= base_url('uploads/sekolah') ?>';

        // FIX: setView di sini cuma jadi initial view sementara, nanti di-override fitBounds()
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
        const bounds = []; // FIX: tampung koordinat sekolah untuk auto-zoom

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
                width:20px; height:20px;
                background:${color};
                border-radius:50% 50% 50% 0;
                transform:rotate(-45deg);
                border:3px solid #fff;
                box-shadow:0 2px 8px rgba(0,0,0,0.3);
            "></div>`,
                iconSize: [20, 20],
                iconAnchor: [10, 20],
                popupAnchor: [0, -24],
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
                            ? `<img src="${FOTO_BASE_URL}/${s.foto}" style="width:100%; height:100px; object-fit:cover; border-radius:6px; margin-bottom:8px;">`
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

                bounds.push([s.latitude, s.longitude]); // FIX: simpan koordinat ke bounds
            }
        });

        // FIX: auto zoom & center ke area sebaran sekolah (sebelumnya fixed setView zoom 11)
        if (bounds.length) {
            map.fitBounds(bounds, {
                padding: [40, 40]
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