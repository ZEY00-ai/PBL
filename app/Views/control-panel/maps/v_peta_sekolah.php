<?php echo view('control-panel/components/header'); ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<body class="app">
<div class="page-container">
    <main class="main-content" id="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="page-header">
                    <div>
                        <h1>Peta Sekolah</h1>
                        <p class="subtitle">Sebaran sekolah di Kabupaten Tanah Datar</p>
                    </div>
                </div>

                <div class="m-card" style="padding: 0; overflow: hidden;">
                    <div id="map" style="height: 600px; width: 100%;"></div>
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Inisialisasi peta, center ke Tanah Datar
    const map = L.map('map').setView([-0.4558, 100.6162], 11);

    // Tile layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Data sekolah dari controller (PHP ke JS)
    const sekolah = <?= json_encode($sekolah) ?>;

    // Tambahkan marker untuk setiap sekolah
    sekolah.forEach(function(s) {
        if (s.latitude && s.longitude) {
            const marker = L.marker([s.latitude, s.longitude]).addTo(map);
            marker.bindPopup(`
                <div style="min-width:180px">
                    ${s.foto
                        ? `<img src="/uploads/sekolah/${s.foto}" style="width:100%; height:100px; object-fit:cover; border-radius:6px; margin-bottom:8px;">`
                        : ''
                    }
                    <strong>${s.nama_sekolah}</strong><br>
                    <small><i class="fa-solid fa-location-dot"></i> ${s.kecamatan}</small><br>
                    <small>${s.alamat}</small>
                </div>
            `);
        }
    });
</script>

<?php echo view('control-panel/components/footer'); ?>
</body>