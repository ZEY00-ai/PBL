const sekolah = window.SEKOLAH_DATA || [];
const geojsonData = window.GEOJSON_DATA || [];
const maptilerKey = window.MAPTILER_KEY || '';
const fotoSekolahUrl = window.FOTO_SEKOLAH_URL || '';
const sekolahDetailUrl = window.SEKOLAH_DETAIL_URL || '';

const tileLayerUrl = maptilerKey ?
    `https://api.maptiler.com/maps/streets/256/{z}/{x}/{y}.png?key=${maptilerKey}` :
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

const tileLayerAttribution = maptilerKey ?
    '© MapTiler © OpenStreetMap contributors' :
    '&copy; OpenStreetMap contributors';

const streets = L.tileLayer(tileLayerUrl, {
    attribution: tileLayerAttribution,
    maxZoom: 19
});

const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap & CartoDB',
    maxZoom: 19
});

const satellite = maptilerKey ?
    L.tileLayer(`https://api.maptiler.com/maps/hybrid/256/{z}/{x}/{y}.png?key=${maptilerKey}`, {
        attribution: '© MapTiler © OpenStreetMap contributors',
        maxZoom: 19
    }) :
    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri',
        maxZoom: 19
    });

const map = L.map('map', {
    center: [-0.2733009989610224, 100.48442111207578],
    zoom: 12,
    layers: [streets]
});

const baseLayers = {
    'Streets': streets,
    'Dark': dark,
    'Satellite': satellite
};

// GeoJSON Wilayah Kecamatan
geojsonData.forEach(function (item) {
    try {
        const geoData = typeof item.geojson === 'string' ? JSON.parse(item.geojson) : item.geojson;
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
                layer.on('mouseover', function () {
                    layer.setStyle({ fillOpacity: 0.6 });
                });
                layer.on('mouseout', function () {
                    layer.setStyle({ fillOpacity: 0.3 });
                });
            }
        }).addTo(map);
    } catch (e) {
        console.error('GeoJSON tidak valid: ' + item.nama_kecamatan);
    }
});

// Warna marker sesuai tingkatan
function getMarkerColor(tingkatan) {
    switch (tingkatan) {
        case 'TK': return 'green';
        case 'SD': return 'red';
        case 'SMP': return 'navy';
        default: return 'blue';
    }
}

function createTingkatanIcon(color) {
    return L.divIcon({
        className: '',
        html: `
            <div style="position:relative; width:26px; height:26px;">
                <div style="
                    width:22px; height:22px;
                    background:${color};
                    border-radius:50% 50% 50% 0;
                    transform:rotate(-45deg);
                    border:3px solid #fff;
                    box-shadow:0 2px 8px rgba(0,0,0,0.3);
                "></div>
            </div>
        `,
        iconSize: [26, 26],
        iconAnchor: [13, 26],
        popupAnchor: [0, -28],
    });
}

function popupSekolah(s, markerColor) {
    return `
        <div style="min-width:200px;">
            <strong>${s.nama_sekolah}</strong><br>
            <p class="small mb-1">${s.alamat || ''}</p>
            ${s.foto ? `<img src="${fotoSekolahUrl}/${s.foto}" alt="Foto sekolah" style="width:100%; height:100px; object-fit:cover; border-radius:6px;">` : ''}
            <div style="display:flex; gap:6px; margin-top:6px; flex-wrap:wrap;">
                <span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:${markerColor}; color:#fff;">
                    ${s.tingkatan ?? '-'}
                </span>
                ${s.akreditasi ? `<span style="padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; background:#475569; color:#fff;">Akreditasi ${s.akreditasi}</span>` : ''}
            </div>
                <div style="margin-top:10px; padding-top:8px; border-top:1px solid #e2e8f0;">
            <a href="${sekolahDetailUrl}${s.id}" 
                style="display:inline-flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:#4272d7; text-decoration:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Lihat profil sekolah
            </a>
        </div>
        </div>
    `;
}

let markerLayer = L.layerGroup().addTo(map);
const allMarkers = [];

sekolah.forEach(function (s) {
    if (!s.latitude || !s.longitude) return;
    const lat = parseFloat(s.latitude);
    const lng = parseFloat(s.longitude);
    if (Number.isNaN(lat) || Number.isNaN(lng)) return;
    allMarkers.push({ data: s, lat: lat, lng: lng });
});

// renderMarkers: hanya render marker, TANPA zoom
function renderMarkers(list) {
    markerLayer.clearLayers();
    list.forEach(function (item) {
        const s = item.data;
        const markerColor = getMarkerColor(s.tingkatan);
        const marker = L.marker([item.lat, item.lng], {
            icon: createTingkatanIcon(markerColor)
        });
        marker.bindPopup(popupSekolah(s, markerColor));
        marker.addTo(markerLayer);
    });
}

// Render awal + zoom ke semua marker
renderMarkers(allMarkers);
if (allMarkers.length) {
    map.fitBounds(allMarkers.map(m => [m.lat, m.lng]), { padding: [40, 40] });
}

// ── Pencarian & Filter ─────────────────────────────
const searchInput = document.getElementById('dt-search-input');
const jenjangSelect = document.getElementById('filter-jenjang');
const kecamatanSelect = document.getElementById('filter-kecamatan');
const akreditasiSelect = document.getElementById('filter-akreditasi');
const btnCari = document.getElementById('btn-cari-sekolah');
const btnReset = document.getElementById('btn-reset-filter');
const resultInfo = document.getElementById('search-result-info');

function filterSekolah() {
    const keyword = (searchInput ? searchInput.value : '').toLowerCase().trim();
    const jenjang = jenjangSelect ? jenjangSelect.value : '';
    const kecamatan = kecamatanSelect ? kecamatanSelect.value : '';
    const akreditasi = akreditasiSelect ? akreditasiSelect.value : '';

    const hasil = allMarkers.filter(function (item) {
        const s = item.data;
        const matchKeyword = !keyword || s.nama_sekolah.toLowerCase().includes(keyword);
        const matchJenjang = !jenjang || s.tingkatan === jenjang;
        const matchKecamatan = !kecamatan || s.kecamatan === kecamatan;
        const matchAkreditasi = !akreditasi || s.akreditasi === akreditasi;
        return matchKeyword && matchJenjang && matchKecamatan && matchAkreditasi;
    });

    // Render marker dulu
    renderMarkers(hasil);

    // Zoom hanya diubah kalau ada hasil.
    // Kalau hasil kosong, posisi & zoom map dibiarkan tetap seperti sebelumnya.
    if (hasil.length === 1) {
        map.setView([hasil[0].lat, hasil[0].lng], 16);
    } else if (hasil.length > 1) {
        map.fitBounds(hasil.map(m => [m.lat, m.lng]), { padding: [40, 40], maxZoom: 14 });
    }

    if (resultInfo) {
        resultInfo.innerHTML = `<i class="fa-solid fa-circle-info"></i> Ditemukan <strong>${hasil.length}</strong> sekolah sesuai filter.`;
    }
}

function resetFilter() {
    if (searchInput) searchInput.value = '';
    if (jenjangSelect) jenjangSelect.value = '';
    if (kecamatanSelect) kecamatanSelect.value = '';
    if (akreditasiSelect) akreditasiSelect.value = '';
    if (resultInfo) resultInfo.innerHTML = '';
    renderMarkers(allMarkers);
    map.fitBounds(allMarkers.map(m => [m.lat, m.lng]), { padding: [40, 40] });
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

window.addEventListener('load', function () {
    map.invalidateSize();
});

setTimeout(function () {
    map.invalidateSize();
}, 300);