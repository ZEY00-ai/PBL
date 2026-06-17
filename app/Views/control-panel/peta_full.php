<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Interaktif - SIG Sekolah Tanah Datar</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="<?= base_url('CoolAdmin-master/vendor/fontawesome-7.2.0/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.min.css') ?>" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .peta-wrap {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Side Panel */
        .side-panel {
            width: 340px;
            background: #fff;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .side-panel__header {
            padding: 18px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .side-panel__header .btn-back {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            text-decoration: none;
            flex-shrink: 0;
        }

        .side-panel__header .btn-back:hover {
            background: #e2e8f0;
        }

        .side-panel__header h5 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
            color: #1e293b;
        }

        .side-panel__header p {
            font-size: 11.5px;
            color: #64748b;
            margin: 0;
        }

        .side-panel__body {
            padding: 20px;
            overflow-y: auto;
            flex: 1;
        }

        .form-label-sm {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
            display: block;
        }

        .legend-box {
            background: #f8fafc;
            border-radius: 10px;
            padding: 14px 16px;
            margin-top: 16px;
        }

        .legend-box p {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            margin-bottom: 6px;
        }

        .legend-dot {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .result-list {
            margin-top: 16px;
            max-height: 280px;
            overflow-y: auto;
        }

        .result-item {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-bottom: 8px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .result-item:hover {
            background: #f1f5f9;
        }

        .result-item__title {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .result-item__sub {
            font-size: 11.5px;
            color: #64748b;
            margin-top: 2px;
        }

        .result-info {
            font-size: 12px;
            color: #64748b;
            margin-top: 12px;
            padding: 8px 10px;
            background: #eef2ff;
            border-radius: 8px;
            display: none;
        }

        .result-info.show {
            display: block;
        }

        /* Map */
        .map-container {
            flex: 1;
            position: relative;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .side-panel {
                position: absolute;
                height: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="peta-wrap">

        <!-- Side Panel -->
        <aside class="side-panel">
            <div class="side-panel__header">
                <a href="<?= base_url('/') ?>" class="btn-back" title="Kembali ke Beranda">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h5>Peta Interaktif</h5>
                    <p>SIG Sekolah Tanah Datar</p>
                </div>
            </div>

            <div class="side-panel__body">

                <label class="form-label-sm">Cari Sekolah</label>
                <input type="search" id="search-input" class="form-control mb-3" placeholder="Nama sekolah...">

                <label class="form-label-sm">Jenjang Pendidikan</label>
                <select id="filter-jenjang" class="form-select mb-3">
                    <option value="">Semua Jenjang</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                </select>

                <label class="form-label-sm">Kecamatan</label>
                <select id="filter-kecamatan" class="form-select mb-3">
                    <option value="">Semua Kecamatan</option>
                    <?php
                    $daftarKecamatan = array_unique(array_column($sekolah ?? [], 'kecamatan'));
                    ?>
                    <?php foreach ($daftarKecamatan as $kec): ?>
                        <?php if ($kec): ?>
                            <option value="<?= esc($kec) ?>"><?= esc($kec) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

                <label class="form-label-sm">Akreditasi</label>
                <select id="filter-akreditasi" class="form-select mb-3">
                    <option value="">Semua Akreditasi</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>

                <button id="btn-cari" class="btn btn-primary w-100 fw-bold mb-2">
                    <i class="fa-solid fa-search"></i> Cari
                </button>
                <button id="btn-reset" type="button" class="btn btn-outline-secondary w-100 fw-bold">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </button>

                <div id="result-info" class="result-info"></div>
                <div id="result-list" class="result-list"></div>

                <div class="legend-box">
                    <p>Tingkatan Sekolah</p>
                    <div class="legend-item"><span class="legend-dot" style="background:green;"></span> TK</div>
                    <div class="legend-item"><span class="legend-dot" style="background:red;"></span> SD</div>
                    <div class="legend-item"><span class="legend-dot" style="background:navy;"></span> SMP</div>
                </div>

                <?php if (!empty($geojson)): ?>
                    <div class="legend-box">
                        <p>Wilayah Kecamatan</p>
                        <?php foreach ($geojson as $g): ?>
                            <div class="legend-item">
                                <span style="width:13px; height:13px; border-radius:4px; background:<?= esc($g['warna']) ?>; opacity:0.7; display:inline-block;"></span>
                                <?= esc($g['nama_kecamatan']) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </aside>

        <!-- Map -->
        <div class="map-container">
            <div id="map"></div>
        </div>

    </div>

    <script>
        const sekolah = <?= json_encode($sekolah ?? []) ?>;
        const geojsonData = <?= json_encode($geojson ?? []) ?>;

        const map = L.map('map', {
            center: [-0.2733009989610224, 100.48442111207578],
            zoom: 12
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // GeoJSON Kecamatan
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
            } catch (e) {}
        });

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
                html: `<div style="
                width:22px; height:22px;
                background:${color};
                border-radius:50% 50% 50% 0;
                transform:rotate(-45deg);
                border:3px solid #fff;
                box-shadow:0 2px 8px rgba(0,0,0,0.3);
            "></div>`,
                iconSize: [22, 22],
                iconAnchor: [11, 22],
                popupAnchor: [0, -26],
            });
        }

        function popupSekolah(s, color) {
            return `
            <div style="min-width:200px;">
                <strong>${s.nama_sekolah}</strong><br>
                <small>${s.kecamatan || ''}</small><br>
                <p style="font-size:12px; margin:4px 0;">${s.alamat || ''}</p>
                ${s.foto ? `<img src="<?= base_url('uploads/sekolah') ?>/${s.foto}" style="width:100%; height:90px; object-fit:cover; border-radius:6px;">` : ''}
                <div style="display:flex; gap:6px; margin-top:6px;">
                    <span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:${color}; color:#fff;">${s.tingkatan ?? '-'}</span>
                    ${s.akreditasi ? `<span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:#475569; color:#fff;">Akreditasi ${s.akreditasi}</span>` : ''}
                </div>
            </div>
        `;
        }

        let markerLayer = L.layerGroup().addTo(map);
        let markerRefs = {};
        const allMarkers = [];

        sekolah.forEach(function(s) {
            if (!s.latitude || !s.longitude) return;
            const lat = parseFloat(s.latitude);
            const lng = parseFloat(s.longitude);
            if (Number.isNaN(lat) || Number.isNaN(lng)) return;
            allMarkers.push({
                data: s,
                lat: lat,
                lng: lng
            });
        });

        function renderMarkers(list) {
            markerLayer.clearLayers();
            markerRefs = {};
            const bounds = [];

            list.forEach(function(item, idx) {
                const s = item.data;
                const color = getMarkerColor(s.tingkatan);
                const marker = L.marker([item.lat, item.lng], {
                    icon: createIcon(color)
                });
                marker.bindPopup(popupSekolah(s, color));
                marker.addTo(markerLayer);
                markerRefs[s.id] = marker;
                bounds.push([item.lat, item.lng]);
            });

            if (bounds.length) map.fitBounds(bounds, {
                padding: [40, 40]
            });
            renderResultList(list);
        }

        function renderResultList(list) {
            const container = document.getElementById('result-list');
            container.innerHTML = '';

            list.forEach(function(item) {
                const s = item.data;
                const div = document.createElement('div');
                div.className = 'result-item';
                div.innerHTML = `
                <div class="result-item__title">🏫 ${s.nama_sekolah}</div>
                <div class="result-item__sub">${s.kecamatan || ''} · ${s.tingkatan || '-'}</div>
            `;
                div.addEventListener('click', function() {
                    map.setView([item.lat, item.lng], 16);
                    if (markerRefs[s.id]) markerRefs[s.id].openPopup();
                });
                container.appendChild(div);
            });
        }

        renderMarkers(allMarkers);

        // Filter
        const searchInput = document.getElementById('search-input');
        const jenjangSelect = document.getElementById('filter-jenjang');
        const kecamatanSelect = document.getElementById('filter-kecamatan');
        const akreditasiSelect = document.getElementById('filter-akreditasi');
        const btnCari = document.getElementById('btn-cari');
        const btnReset = document.getElementById('btn-reset');
        const resultInfo = document.getElementById('result-info');

        function filterSekolah() {
            const keyword = (searchInput.value || '').toLowerCase().trim();
            const jenjang = jenjangSelect.value;
            const kecamatan = kecamatanSelect.value;
            const akreditasi = akreditasiSelect.value;

            const hasil = allMarkers.filter(function(item) {
                const s = item.data;
                const matchKeyword = !keyword || s.nama_sekolah.toLowerCase().includes(keyword);
                const matchJenjang = !jenjang || s.tingkatan === jenjang;
                const matchKecamatan = !kecamatan || s.kecamatan === kecamatan;
                const matchAkreditasi = !akreditasi || s.akreditasi === akreditasi;
                return matchKeyword && matchJenjang && matchKecamatan && matchAkreditasi;
            });

            renderMarkers(hasil);
            resultInfo.classList.add('show');
            resultInfo.innerHTML = `<i class="fa-solid fa-circle-info"></i> Ditemukan <strong>${hasil.length}</strong> sekolah.`;
        }

        function resetFilter() {
            searchInput.value = '';
            jenjangSelect.value = '';
            kecamatanSelect.value = '';
            akreditasiSelect.value = '';
            resultInfo.classList.remove('show');
            renderMarkers(allMarkers);
        }

        btnCari.addEventListener('click', filterSekolah);
        btnReset.addEventListener('click', resetFilter);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') filterSekolah();
        });
    </script>

</body>

</html>