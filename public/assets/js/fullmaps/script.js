document.addEventListener('DOMContentLoaded', function () {
    const sekolahData = window.SEKOLAH_DATA || [];
    const geojsonData = window.GEOJSON_DATA || [];
    const fotoUrl = window.FOTO_SEKOLAH_URL || '';
    const sekolahDetailUrl = window.SEKOLAH_DETAIL_URL || '';

    const mapDiv = document.getElementById('map');
    if (!mapDiv) return;

    // ── Burger Menu Toggle (Mobile) ─────────────────────────────
    const btnBurger = document.getElementById('btn-burger');
    const btnClosePanel = document.getElementById('btn-close-panel');
    const sidePanel = document.getElementById('side-panel');
    const panelOverlay = document.getElementById('panel-overlay');

    function openPanel() {
        if (sidePanel) sidePanel.classList.add('open');
        if (panelOverlay) panelOverlay.classList.add('show');
        if (btnBurger) btnBurger.classList.add('open');
    }

    function closePanel() {
        if (sidePanel) sidePanel.classList.remove('open');
        if (panelOverlay) panelOverlay.classList.remove('show');
        if (btnBurger) btnBurger.classList.remove('open');
    }

    if (btnBurger) {
        btnBurger.addEventListener('click', openPanel);
    }
    if (btnClosePanel) {
        btnClosePanel.addEventListener('click', closePanel);
    }
    if (panelOverlay) {
        panelOverlay.addEventListener('click', closePanel);
    }

    // ── Inisialisasi Peta ──────────────────────────────────────
    const map = L.map('map').setView([-0.4558, 100.6162], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
        maxNativeZoom: 19
    }).addTo(map);

    // ── GeoJSON Wilayah Kecamatan ──────────────────────────────
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
                    layer.on('mouseover', function () { layer.setStyle({ fillOpacity: 0.6 }); });
                    layer.on('mouseout', function () { layer.setStyle({ fillOpacity: 0.3 }); });
                }
            }).addTo(map);
        } catch (e) {
            console.error('GeoJSON tidak valid: ' + item.nama_kecamatan);
        }
    });

    // ── Warna Marker ───────────────────────────────────────────
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
                 <div style="margin-top:10px; padding-top:8px; border-top:1px solid #e2e8f0;">
            <a href="${sekolahDetailUrl}${s.id}?from=fullmap"
                style="display:inline-flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:#4272d7; text-decoration:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Lihat profil sekolah
            </a>
        </div>
            </div>
        `;
    }

    // ── Marker Array ───────────────────────────────────────────
    let markerLayer = L.layerGroup().addTo(map);
    let markerRefs = {};
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
        markerRefs = {};
        const bounds = [];

        list.forEach(function (item) {
            const s = item.data;
            const color = getMarkerColor(s.tingkatan);
            const marker = L.marker([item.lat, item.lng], { icon: createIcon(color) });
            marker.bindPopup(popupSekolah(s, color));
            marker.addTo(markerLayer);
            markerRefs[s.id] = marker;
            bounds.push([item.lat, item.lng]);
        });

        return bounds;
    }

    function renderResultList(list) {
        const container = document.getElementById('result-list');
        if (!container) return;
        container.innerHTML = '';

        list.forEach(function (item) {
            const s = item.data;
            const div = document.createElement('div');
            div.className = 'result-item';
            div.innerHTML = `
                <div class="result-item__title">🏫 ${s.nama_sekolah}</div>
                <div class="result-item__sub">${s.kecamatan || ''} · ${s.tingkatan || '-'}</div>
            `;
            div.addEventListener('click', function () {
                map.setView([item.lat, item.lng], 16);
                if (markerRefs[s.id]) markerRefs[s.id].openPopup();
                // Tutup panel otomatis di mobile biar peta kelihatan
                if (window.innerWidth <= 768) closePanel();
            });
            container.appendChild(div);
        });
    }

    // Render awal
    const initBounds = renderMarkers(allMarkers);
    if (initBounds.length) {
        map.fitBounds(initBounds, { padding: [40, 40] });
    }
    renderResultList(allMarkers);

    // ── Pencarian & Filter ──────────────────────────────────────
    // ID sesuai peta_full.php
    const searchInput = document.getElementById('search-input');
    const jenjangSelect = document.getElementById('filter-jenjang');
    const kecamatanSelect = document.getElementById('filter-kecamatan');
    const akreditasiSelect = document.getElementById('filter-akreditasi');
    const btnCari = document.getElementById('btn-cari');
    const btnReset = document.getElementById('btn-reset');
    const resultInfo = document.getElementById('result-info');

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

        const bounds = renderMarkers(hasil);
        renderResultList(hasil);

        // Zoom hanya diubah kalau ada hasil.
        // Kalau hasil kosong, posisi & zoom map dibiarkan tetap seperti sebelumnya.
        if (hasil.length === 1) {
            map.setView([hasil[0].lat, hasil[0].lng], 16);
        } else if (hasil.length > 1) {
            map.fitBounds(bounds, { padding: [40, 40], maxZoom: 14 });
        }

        if (resultInfo) {
            resultInfo.classList.add('show');
            resultInfo.innerHTML = `<i class="fa-solid fa-circle-info"></i> Ditemukan <strong>${hasil.length}</strong> sekolah.`;
        }
    }

    function resetFilter() {
        if (searchInput) searchInput.value = '';
        if (jenjangSelect) jenjangSelect.value = '';
        if (kecamatanSelect) kecamatanSelect.value = '';
        if (akreditasiSelect) akreditasiSelect.value = '';
        if (resultInfo) resultInfo.classList.remove('show');
        const bounds = renderMarkers(allMarkers);
        renderResultList(allMarkers);
        if (bounds.length) {
            map.fitBounds(bounds, { padding: [40, 40] });
        }
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