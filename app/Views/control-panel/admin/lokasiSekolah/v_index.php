<?php echo view('components/header'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map-lokasi { width: 100%; height: 500px; border-radius: 0 0 12px 12px; }
    .leaflet-popup-content-wrapper { border-radius: 8px; }
    .info-banner {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
        color: #1e40af;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-label-custom { font-weight: 500; font-size: 14px; color: #1f2937; margin-bottom: 6px; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .form-control { padding-right: 38px; }
    .input-icon-wrap .icon-suffix {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; pointer-events: none;
    }
    .preview-lokasi-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px 16px;
    }
    .map-footer-info {
        display: flex; gap: 24px; font-size: 13px; color: #475569;
        padding: 10px 16px; border-top: 1px solid #f1f5f9;
    }
    .map-footer-info span i { margin-right: 5px; color: #3b82f6; }
</style>

<body class="app">
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header mb-4">
                        <h1 class="h3 mb-1 text-dark fw-bold">Lokasi Sekolah</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small mb-0" style="background: none; padding: 0;">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lokasi Sekolah</li>
                            </ol>
                        </nav>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert"><?= esc(session()->getFlashdata('success')) ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
                    <?php endif; ?>

                    <div class="info-banner mb-4">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Atur lokasi sekolah Anda pada peta dengan menandai posisi yang tepat. Marker akan ditampilkan pada peta publik.</span>
                    </div>

                    <form id="form-lokasi" action="<?= site_url('admin/profileSekolah/updateLokasi/' . $sekolah['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row g-4">

                            <div class="col-lg-4">
                                <section class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #ffffff;">
                                    <h5 class="fw-bold text-dark mb-1">Informasi Lokasi</h5>
                                    <p class="text-muted small mb-4">Geser marker pada peta untuk menentukan lokasi sekolah atau klik pada peta untuk menempatkan marker.</p>

                                    <div class="mb-3">
                                        <label class="form-label-custom" for="input-latitude">Latitude</label>
                                        <div class="input-icon-wrap">
                                            <input type="text" class="form-control" id="input-latitude" name="latitude"
                                                value="<?= esc($sekolah['latitude'] ?? '') ?>" placeholder="-0.947123" autocomplete="off">
                                            <i class="fa-solid fa-location-dot icon-suffix"></i>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label-custom" for="input-longitude">Longitude</label>
                                        <div class="input-icon-wrap">
                                            <input type="text" class="form-control" id="input-longitude" name="longitude"
                                                value="<?= esc($sekolah['longitude'] ?? '') ?>" placeholder="100.354567" autocomplete="off">
                                            <i class="fa-solid fa-location-dot icon-suffix"></i>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label-custom" for="input-alamat">Alamat</label>
                                        <textarea class="form-control" id="input-alamat" name="alamat" rows="3"
                                            placeholder="Jl. Pendidikan No. 10, Kecamatan, Kabupaten, Provinsi"><?= esc($sekolah['alamat'] ?? '') ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label-custom" for="input-radius">
                                            Radius (meter)
                                            <i class="fa-solid fa-circle-question text-muted" title="Radius digunakan untuk menampilkan area sekitar sekolah pada peta."></i>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="input-radius" name="radius"
                                                value="<?= esc($sekolah['radius'] ?? 100) ?>" min="10" step="10">
                                            <span class="input-group-text">m</span>
                                        </div>
                                        <small class="text-muted">Radius digunakan untuk menampilkan area sekitar sekolah pada peta.</small>
                                    </div>

                                    <div class="preview-lokasi-box mb-3">
                                        <p class="fw-bold text-dark mb-2" style="font-size: 14px;">Preview Lokasi</p>
                                        <div class="d-flex align-items-start gap-2">
                                            <i class="fa-solid fa-location-dot text-primary mt-1"></i>
                                            <div>
                                                <p class="fw-semibold text-dark mb-0" style="font-size: 14px;" id="preview-nama">
                                                    <?= esc($sekolah['nama_sekolah'] ?? 'Nama Sekolah') ?>
                                                </p>
                                                <p class="text-muted mb-0" style="font-size: 13px;" id="preview-alamat">
                                                    <?= esc($sekolah['alamat'] ?? 'Alamat belum diisi') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="button" id="btn-reset" class="btn btn-outline-secondary flex-fill" style="border-radius: 8px;">
                                            <i class="fa-solid fa-rotate-left me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary flex-fill" style="border-radius: 8px;">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Lokasi
                                        </button>
                                    </div>
                                </section>
                            </div>

                            <div class="col-lg-8">
                                <section class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: #ffffff; overflow: hidden;">
                                    <div class="d-flex justify-content-between align-items-center p-4 pb-3">
                                        <h5 class="fw-bold text-dark mb-0">Peta Lokasi Sekolah</h5>
                                        <a href="<?= site_url('fullmaps') ?>" target="_blank" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                            <i class="fa-solid fa-up-right-and-down-left-from-center me-1"></i> Tampilan Peta Penuh
                                        </a>
                                    </div>

                                    <div id="map-lokasi"></div>

                                    <div class="map-footer-info">
                                        <span><i class="fa-solid fa-location-dot"></i>Latitude: <span id="footer-lat"><?= esc($sekolah['latitude'] ?? '-') ?></span></span>
                                        <span><i class="fa-solid fa-globe"></i>Longitude: <span id="footer-lng"><?= esc($sekolah['longitude'] ?? '-') ?></span></span>
                                        <span><i class="fa-solid fa-circle-dot"></i>Radius: <span id="footer-radius"><?= esc($sekolah['radius'] ?? 100) ?></span> m</span>
                                    </div>
                                </section>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('components/footer'); ?>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        (function () {
            const defaultLat = <?= !empty($sekolah['latitude']) ? esc($sekolah['latitude']) : -0.947123 ?>;
            const defaultLng = <?= !empty($sekolah['longitude']) ? esc($sekolah['longitude']) : 100.354567 ?>;
            const defaultRadius = <?= !empty($sekolah['radius']) ? (int) $sekolah['radius'] : 100 ?>;
            const namaSekolah = <?= json_encode($sekolah['nama_sekolah'] ?? 'Lokasi Sekolah') ?>;

            const latInput = document.getElementById('input-latitude');
            const lngInput = document.getElementById('input-longitude');
            const radiusInput = document.getElementById('input-radius');
            const alamatInput = document.getElementById('input-alamat');

            const footerLat = document.getElementById('footer-lat');
            const footerLng = document.getElementById('footer-lng');
            const footerRadius = document.getElementById('footer-radius');
            const previewAlamat = document.getElementById('preview-alamat');

            const map = L.map('map-lokasi').setView([defaultLat, defaultLng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], { draggable: true })
                .addTo(map)
                .bindPopup(`<strong>${namaSekolah}</strong><br>${defaultLat}, ${defaultLng}`)
                .openPopup();

            const circle = L.circle([defaultLat, defaultLng], {
                radius: defaultRadius,
                color: '#3b82f6',
                fillColor: '#3b82f6',
                fillOpacity: 0.15,
                dashArray: '6 4'
            }).addTo(map);

            function updatePosition(lat, lng) {
                lat = parseFloat(lat).toFixed(6);
                lng = parseFloat(lng).toFixed(6);

                marker.setLatLng([lat, lng]);
                circle.setLatLng([lat, lng]);
                marker.setPopupContent(`<strong>${namaSekolah}</strong><br>${lat}, ${lng}`);

                latInput.value = lat;
                lngInput.value = lng;
                footerLat.textContent = lat;
                footerLng.textContent = lng;
            }

            function updateRadius(radius) {
                radius = parseInt(radius) || 0;
                circle.setRadius(radius);
                footerRadius.textContent = radius;
            }

            // Drag marker
            marker.on('dragend', function (e) {
                const pos = e.target.getLatLng();
                updatePosition(pos.lat, pos.lng);
            });

            // Klik di peta untuk pindahkan marker
            map.on('click', function (e) {
                updatePosition(e.latlng.lat, e.latlng.lng);
            });

            // Edit manual lewat input lat/lng
            [latInput, lngInput].forEach(input => {
                input.addEventListener('change', function () {
                    const lat = parseFloat(latInput.value);
                    const lng = parseFloat(lngInput.value);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        map.setView([lat, lng]);
                        updatePosition(lat, lng);
                    }
                });
            });

            // Edit radius manual
            radiusInput.addEventListener('input', function () {
                updateRadius(radiusInput.value);
            });

            // Sinkronkan preview alamat
            alamatInput.addEventListener('input', function () {
                previewAlamat.textContent = alamatInput.value || 'Alamat belum diisi';
            });

            // Reset ke posisi awal dari database
            document.getElementById('btn-reset').addEventListener('click', function () {
                latInput.value = defaultLat;
                lngInput.value = defaultLng;
                radiusInput.value = defaultRadius;
                map.setView([defaultLat, defaultLng], 16);
                updatePosition(defaultLat, defaultLng);
                updateRadius(defaultRadius);
            });

            // Pastikan peta render penuh (kasus container baru muncul/flex layout)
            setTimeout(() => map.invalidateSize(), 200);
        })();
    </script>
</body>