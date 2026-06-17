(function () {
    const tbody    = document.getElementById('dt-body');
    const empty    = document.getElementById('dt-empty');
    const search   = document.getElementById('dt-search-input');
    const pageSize = document.getElementById('dt-page-size');
    const info     = document.getElementById('dt-info');
    const nav      = document.getElementById('dt-nav');
    const clearBtn = document.getElementById('dt-clear-search');

    if (!tbody) return;

    const allRows = Array.from(tbody.querySelectorAll('tr'));

    // Ambil state dari localStorage
    let page    = parseInt(localStorage.getItem('dt_page') || '1', 10);
    let perPage = parseInt(localStorage.getItem('dt_perpage') || '10', 10);
    let query   = '';

    // Set dropdown sesuai localStorage
    if (pageSize) pageSize.value = perPage;

    function saveState() {
        localStorage.setItem('dt_page', page);
        localStorage.setItem('dt_perpage', perPage);
    }

    function render() {
        const q = query.trim().toLowerCase();

        const filtered = q
            ? allRows.filter(r => r.textContent.toLowerCase().includes(q))
            : allRows.slice();

        const total      = filtered.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));

        if (page > totalPages) page = totalPages;
        if (page < 1) page = 1;

        const start = (page - 1) * perPage;
        const end   = start + perPage;

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
            b.disabled  = disabled;
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

    if (search) search.oninput = function () { query = search.value; page = 1; render(); };

    if (pageSize) pageSize.onchange = function () {
        perPage = parseInt(pageSize.value, 10);
        page = 1;
        render();
    };

    if (clearBtn) clearBtn.onclick = function () {
        search.value = '';
        query = '';
        page  = 1;
        render();
    };

    render();
})();