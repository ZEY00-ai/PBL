document.addEventListener('DOMContentLoaded', function () {
    const sekolahData = window.SEKOLAH_DATA || [];
    const geojsonData = window.GEOJSON_DATA || [];
    const maptilerKey = window.MAPTILER_KEY || '';
    const fotoUrl = window.FOTO_SEKOLAH_URL || '';

    const mapDiv = document.getElementById('map');
    if (!mapDiv) return;

    // ── Inisialisasi Peta ──────────────────────────────────────
    const map = L.map('map').setView([-0.4558, 100.6162], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 12,
        maxNativeZoom: 19
    }).addTo(map);

    // ── GeoJSON Wilayah Kecamatan ──────────────────────────────
    geojsonData.forEach(function (item) {
        try {
            const geoData = JSON.parse(item.geojson);
            L.geoJSON(geoData, {
                style: {
                    color: item.warna,
                    weight: 2,
                    fillColor: item.warna,
                    fillOpacity: 0.3,
                },
                onEachFeature: function (feature, layer) {
                    layer.on('click', function () {
                        layer.bindPopup('<strong>📍 ' + item.nama_kecamatan + '</strong>').openPopup();
                    });
                    layer.on('mouseover', function () { layer.setStyle({ fillOpacity: 0.6 }); });
                    layer.on('mouseout', function () { layer.setStyle({ fillOpacity: 0.3 }); });
                }
            }).addTo(map);
        } catch (e) {
            console.error('GeoJSON tidak valid: ' + item.nama_kecamatan);
        }
    });

    // ── Warna Marker Sesuai Tingkatan ──────────────────────────
    function getMarkerColor(tingkatan) {
        switch (tingkatan) {
            case 'TK': return 'green';
            case 'SD': return 'red';
            case 'SMP': return 'navy';
            default: return 'gray';
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
            <div style="min-width:190px;">
                ${s.foto ? `<img src="${fotoUrl}/${s.foto}" style="width:100%; height:90px; object-fit:cover; border-radius:6px; margin-bottom:6px;">` : ''}
                <strong>🏫 ${s.nama_sekolah}</strong><br>
                <small>📍 ${s.kecamatan || ''}</small><br>
                <small>${s.alamat || ''}</small>
                <div style="display:flex; gap:6px; margin-top:6px; flex-wrap:wrap;">
                    <span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:${color}; color:#fff;">
                        ${s.tingkatan ?? '-'}
                    </span>
                    ${s.akreditasi ? `<span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:#475569; color:#fff;">Akreditasi ${s.akreditasi}</span>` : ''}
                </div>
            </div>
        `;
    }

    // ── Simpan Marker ke Array ─────────────────────────────────
    let markerLayer = L.layerGroup().addTo(map);
    const allMarkers = [];

    sekolahData.forEach(function (s) {
        if (!s.latitude || !s.longitude) return;
        const lat = parseFloat(s.latitude);
        const lng = parseFloat(s.longitude);
        if (Number.isNaN(lat) || Number.isNaN(lng)) return;
        allMarkers.push({ data: s, lat: lat, lng: lng });
    });

    function renderMarkers(list) {
        markerLayer.clearLayers();
        const bounds = [];

        list.forEach(function (item) {
            const s = item.data;
            const color = getMarkerColor(s.tingkatan);
            const marker = L.marker([item.lat, item.lng], { icon: createIcon(color) });
            marker.bindPopup(popupSekolah(s, color));
            marker.addTo(markerLayer);
            bounds.push([item.lat, item.lng]);
        });

        if (bounds.length) {
            map.fitBounds(bounds, { padding: [40, 40] });
        }
    }

    // Render semua marker pertama kali
    renderMarkers(allMarkers);

    // ── Pencarian & Filter ──────────────────────────────────────
    const searchInput = document.getElementById('dt-search-input');
    const jenjangSelect = document.getElementById('filter-jenjang');
    const kecamatanSelect = document.getElementById('filter-kecamatan');
    const akreditasiSelect = document.getElementById('filter-akreditasi');
    const btnCari = document.getElementById('btn-cari-sekolah');
    const btnReset = document.getElementById('btn-reset-filter');
    const resultInfo = document.getElementById('search-result-info');

    function filterSekolah() {
        const keyword = (searchInput.value || '').toLowerCase().trim();
        const jenjang = jenjangSelect.value;
        const kecamatan = kecamatanSelect.value;
        const akreditasi = akreditasiSelect.value;

        const hasil = allMarkers.filter(function (item) {
            const s = item.data;

            const matchKeyword = !keyword || s.nama_sekolah.toLowerCase().includes(keyword);
            const matchJenjang = !jenjang || s.tingkatan === jenjang;
            const matchKecamatan = !kecamatan || s.kecamatan === kecamatan;
            const matchAkreditasi = !akreditasi || s.akreditasi === akreditasi;

            return matchKeyword && matchJenjang && matchKecamatan && matchAkreditasi;
        });

        renderMarkers(hasil);

        if (resultInfo) {
            resultInfo.classList.add('show');
            resultInfo.innerHTML = `<i class="fa-solid fa-circle-info"></i> Ditemukan <strong>${hasil.length}</strong> sekolah sesuai filter.`;
        }

        if (hasil.length === 0) {
            map.setView([-0.4558, 100.6162], 11);
        }
    }

    function resetFilter() {
        searchInput.value = '';
        jenjangSelect.value = '';
        kecamatanSelect.value = '';
        akreditasiSelect.value = '';
        if (resultInfo) resultInfo.classList.remove('show');
        renderMarkers(allMarkers);
    }

    if (btnCari) {
        btnCari.addEventListener('click', function (e) {
            e.preventDefault();
            filterSekolah();
        });
    }

    if (btnReset) {
        btnReset.addEventListener('click', function (e) {
            e.preventDefault();
            resetFilter();
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                filterSekolah();
            }
        });
    }
});