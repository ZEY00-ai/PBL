document.addEventListener('DOMContentLoaded', function () {
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const mapDiv = document.getElementById('map');
    const selectKecamatan = document.querySelector('select[name="geojson_id"]');

    if (!mapDiv) return;

    // Ambil koordinat awal dari data lama
    let lat = parseFloat(window.editLatitude) || -0.4558;
    let lng = parseFloat(window.editLongitude) || 100.6162;

    const map = L.map('map').setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Fix: kalau container peta belum punya ukuran final saat init
    // (misal karena layout Bootstrap flex belum settle), paksa recalculate.
    setTimeout(function () {
        map.invalidateSize();
    }, 300);

    // Marker awal sesuai data lama
    let marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    // Saat marker di-drag, update input lat/lng
    marker.on('dragend', function () {
        const pos = marker.getLatLng();
        latInput.value = pos.lat.toFixed(8);
        lngInput.value = pos.lng.toFixed(8);
    });

    // Saat klik di peta, pindahkan marker & update input
    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        latInput.value = e.latlng.lat.toFixed(8);
        lngInput.value = e.latlng.lng.toFixed(8);
    });

    // Saat input lat/lng diubah manual, update posisi marker
    function updateMarkerFromInput() {
        const newLat = parseFloat(latInput.value);
        const newLng = parseFloat(lngInput.value);

        if (!isNaN(newLat) && !isNaN(newLng)) {
            const newPos = [newLat, newLng];
            marker.setLatLng(newPos);
            map.setView(newPos, map.getZoom());
        }
    }

    latInput.addEventListener('change', updateMarkerFromInput);
    lngInput.addEventListener('change', updateMarkerFromInput);

    // ===== Kecamatan (GeoJSON) =====

    if (typeof geojsonData === 'undefined') {
        console.warn('[edit_sekolah.js] geojsonData tidak terdefinisi. Cek view edit & controller.');
    }

    let activeLayer = null;

    function showKecamatan(selectedId) {
        // hapus layer kecamatan sebelumnya (kalau ada)
        if (activeLayer) {
            map.removeLayer(activeLayer);
            activeLayer = null;
        }

        if (!selectedId) return;

        const item = (geojsonData || []).find(g => g.id == selectedId);
        if (!item) {
            console.warn('[edit_sekolah.js] data kecamatan tidak ditemukan untuk id', selectedId);
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

            // jangan fitBounds di sini supaya tidak menimpa posisi marker yang sudah ada
            // (kalau mau auto-zoom ke kecamatan, uncomment baris di bawah)
            // map.fitBounds(activeLayer.getBounds());
        } catch (e) {
            console.error('[edit_sekolah.js] GeoJSON tidak valid untuk: ' + item.nama_kecamatan, e);
        }
    }

    if (selectKecamatan) {
        selectKecamatan.addEventListener('change', function () {
            showKecamatan(this.value);
        });

        // Tampilkan kecamatan yang sudah tersimpan saat halaman pertama dibuka
        const initialId = selectKecamatan.value || window.editGeojsonId;
        if (initialId) {
            showKecamatan(initialId);
        }
    } else {
        console.warn('[edit_sekolah.js] select[name="geojson_id"] tidak ditemukan di halaman ini.');
    }
});