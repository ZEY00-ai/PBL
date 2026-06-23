document.addEventListener('DOMContentLoaded', function () {
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const mapDiv = document.getElementById('map');
    const selectKecamatan = document.querySelector('select[name="geojson_id"]');

    if (!mapDiv) {
        console.warn('[script.js] #map tidak ditemukan di halaman ini, skip init peta.');
        return;
    }

    // Default tengah Kabupaten Tanah Datar
    let lat = -0.4558;
    let lng = 100.6162;

    const map = L.map('map').setView([lat, lng], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Cek ketersediaan data geojson (tidak langsung dirender semua, hanya disimpan)
    if (typeof geojsonData === 'undefined') {
        console.warn('[script.js] geojsonData tidak terdefinisi. Cek urutan <script> di view.');
    } else {
        console.log('[script.js] geojsonData diterima:', geojsonData);
    }

    // Hanya satu layer kecamatan aktif di peta dalam satu waktu
    let activeLayer = null;

    function showKecamatan(selectedId) {
        // hapus layer kecamatan sebelumnya (kalau ada)
        if (activeLayer) {
            map.removeLayer(activeLayer);
            activeLayer = null;
        }

        if (!selectedId) return; // user pilih "-- Pilih Kecamatan --"

        const item = (geojsonData || []).find(g => g.id == selectedId);
        if (!item) {
            console.warn('[script.js] data kecamatan tidak ditemukan untuk id', selectedId);
            return;
        }

        try {
            const geoData = JSON.parse(item.geojson);
            activeLayer = L.geoJSON(geoData, {
                style: {
                    color: item.warna,
                    weight: 3,
                    fillColor: item.warna,
                    fillOpacity: 0.35,
                }
            }).bindPopup('<strong>' + item.nama_kecamatan + '</strong>').addTo(map);

            map.fitBounds(activeLayer.getBounds());
        } catch (e) {
            console.error('[script.js] GeoJSON tidak valid untuk: ' + item.nama_kecamatan, e);
        }
    }

    if (selectKecamatan) {
        selectKecamatan.addEventListener('change', function () {
            console.log('[script.js] kecamatan dipilih, id =', this.value);
            showKecamatan(this.value);
        });

        // kalau halaman edit dan select sudah punya value terpilih (old()/value awal), langsung tampilkan
        if (selectKecamatan.value) {
            showKecamatan(selectKecamatan.value);
        }
    } else {
        console.warn('[script.js] select[name="geojson_id"] tidak ditemukan di halaman ini.');
    }

    // Marker (belum ada posisi awal sampai user klik/isi)
    let marker = null;

    function setMarker(latlng) {
        if (marker) {
            marker.setLatLng(latlng);
        } else {
            marker = L.marker(latlng, { draggable: true }).addTo(map);
            marker.on('dragend', function () {
                const pos = marker.getLatLng();
                latInput.value = pos.lat.toFixed(8);
                lngInput.value = pos.lng.toFixed(8);
            });
        }
    }

    // Klik di peta untuk taruh marker
    map.on('click', function (e) {
        setMarker(e.latlng);
        latInput.value = e.latlng.lat.toFixed(8);
        lngInput.value = e.latlng.lng.toFixed(8);
    });

    // Kalau user ketik manual lat/lng, marker ikut muncul/pindah
    function updateMarkerFromInput() {
        const newLat = parseFloat(latInput.value);
        const newLng = parseFloat(lngInput.value);

        console.log('[script.js] input berubah ->', latInput.value, lngInput.value, '| parsed:', newLat, newLng);

        if (!isNaN(newLat) && !isNaN(newLng)) {
            const newPos = [newLat, newLng];
            setMarker(newPos);
            map.setView(newPos, 14);
        }
    }

    if (latInput && lngInput) {
        latInput.addEventListener('input', updateMarkerFromInput);
        lngInput.addEventListener('input', updateMarkerFromInput);
    } else {
        console.warn('[script.js] input #latitude / #longitude tidak ditemukan.');
    }

    // Supaya bisa dicek manual dari console kalau masih ada masalah
    window.__debugMap = map;
});