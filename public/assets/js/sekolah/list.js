(function () {
    const tbody = document.getElementById('dt-body');
    const empty = document.getElementById('dt-empty');
    const search = document.getElementById('dt-search-input');
    const pageSize = document.getElementById('dt-page-size');
    const filterType = document.getElementById('dt-filter-type');
    const filterValue = document.getElementById('dt-filter-value');
    const info = document.getElementById('dt-info');
    const nav = document.getElementById('dt-nav');
    const clearBtn = document.getElementById('dt-clear-search');

    if (!tbody) return;

    const allRows = Array.from(tbody.querySelectorAll('tr'));

    // Ambil state dari localStorage
    let page = parseInt(localStorage.getItem('dt_page') || '1', 10);
    let perPage = parseInt(localStorage.getItem('dt_perpage') || '10', 10);
    let query = '';
    let selectedType = localStorage.getItem('dt_filter_type') || 'kecamatan';
    let selectedValue = localStorage.getItem('dt_filter_value') || '';

    // Set dropdown sesuai localStorage
    if (pageSize) pageSize.value = perPage;
    if (filterType) filterType.value = selectedType;

    // Isi opsi dropdown kedua sesuai jenis filter yang dipilih
    function populateFilterValues() {
        if (!filterValue) return;

        const attr = 'data-' + selectedType;
        const values = new Set();

        allRows.forEach(r => {
            const v = r.getAttribute(attr);
            if (v) values.add(v);
        });

        // Reset opsi lama, sisakan "Semua"
        filterValue.innerHTML = '<option value="">Semua</option>';

        Array.from(values)
            .sort((a, b) => a.localeCompare(b))
            .forEach(v => {
                const opt = document.createElement('option');
                opt.value = v;
                opt.textContent = v;
                filterValue.appendChild(opt);
            });

        // Restore pilihan sebelumnya kalau masih valid untuk jenis filter ini
        if (selectedValue && values.has(selectedValue)) {
            filterValue.value = selectedValue;
        } else {
            selectedValue = '';
            filterValue.value = '';
        }
    }

    function saveState() {
        localStorage.setItem('dt_page', page);
        localStorage.setItem('dt_perpage', perPage);
        localStorage.setItem('dt_filter_type', selectedType);
        localStorage.setItem('dt_filter_value', selectedValue);
    }

    function render() {
        const q = query.trim().toLowerCase();

        let filtered = allRows.slice();

        if (selectedValue) {
            const attr = 'data-' + selectedType;
            filtered = filtered.filter(r => r.getAttribute(attr) === selectedValue);
        }

        if (q) {
            filtered = filtered.filter(r => r.textContent.toLowerCase().includes(q));
        }

        const total = filtered.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));

        if (page > totalPages) page = totalPages;
        if (page < 1) page = 1;

        const start = (page - 1) * perPage;
        const end = start + perPage;

        allRows.forEach(r => r.style.display = 'none');

        if (total === 0) {
            if (empty) empty.style.display = 'flex';
            if (info) info.textContent = 'No results';
        } else {
            if (empty) empty.style.display = 'none';
            filtered.forEach((r, i) => {
                if (i >= start && i < end) r.style.display = '';
            });
            if (info) info.textContent = 'Showing ' + (start + 1) + '–' + Math.min(end, total) + ' of ' + total;
        }

        // Simpan state
        saveState();

        if (!nav) return;
        nav.innerHTML = '';

        function btn(label, toPage, active, disabled) {
            const b = document.createElement('button');
            b.innerHTML = label;
            b.disabled = disabled;
            b.setAttribute('data-page', toPage);
            if (active) b.classList.add('is-active');
            nav.appendChild(b);
        }

        btn('<i class="fa-solid fa-chevron-left"></i>', page - 1, false, page <= 1);
        for (var p = 1; p <= totalPages; p++) {
            btn(String(p), p, p === page, false);
        }
        btn('<i class="fa-solid fa-chevron-right"></i>', page + 1, false, page >= totalPages);

        // Event delegation
        nav.onclick = function (e) {
            const b = e.target.closest('button');
            if (!b || b.disabled) return;
            const toPage = parseInt(b.getAttribute('data-page'), 10);
            if (!toPage || toPage < 1 || toPage > totalPages) return;
            page = toPage;
            render();
        };
    }

    populateFilterValues();

    if (search) search.oninput = function () { query = search.value; page = 1; render(); };

    if (pageSize) pageSize.onchange = function () {
        perPage = parseInt(pageSize.value, 10);
        page = 1;
        render();
    };

    // Ganti jenis filter (Kecamatan / Tingkatan / Akreditasi)
    if (filterType) filterType.onchange = function () {
        selectedType = filterType.value;
        selectedValue = '';
        populateFilterValues();
        page = 1;
        render();
    };

    // Ganti nilai filter (misal pilih "SD" atau "A")
    if (filterValue) filterValue.onchange = function () {
        selectedValue = filterValue.value;
        page = 1;
        render();
    };

    if (clearBtn) clearBtn.onclick = function () {
        search.value = '';
        query = '';
        if (filterValue) filterValue.value = '';
        selectedValue = '';
        page = 1;
        render();
    };

    render();

    // Konfirmasi hapus pakai SweetAlert2 (fallback ke confirm() bawaan kalau Swal belum ke-load)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-hapus-sekolah');
        if (!btn) return;

        e.preventDefault();
        const url = btn.getAttribute('href');
        const nama = btn.dataset.nama;

        if (typeof Swal === 'undefined') {
            if (confirm('Yakin hapus data ' + nama + '?')) {
                window.location.href = url;
            }
            return;
        }

        Swal.fire({
            title: 'Yakin hapus data?',
            html: `Data sekolah <b>${nama}</b> akan dihapus permanen beserta akun operator yang terkait.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
})();