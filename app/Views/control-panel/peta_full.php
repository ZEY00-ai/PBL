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
    <link rel="stylesheet" href="<?= base_url('assets/css/fullmaps/style.css') ?>" />

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
                    <?php
                    $daftarAkreditasi = array_unique(array_column(array_filter($sekolah ?? [], fn($s) => !empty($s['akreditasi'])), 'akreditasi'));
                    sort($daftarAkreditasi);
                    ?>
                    <?php foreach ($daftarAkreditasi as $akred): ?>
                        <?php if ($akred): ?>
                            <option value="<?= esc($akred) ?>"><?= esc($akred) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
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
        window.SEKOLAH_DATA = <?= json_encode($sekolah ?? []) ?>;
        window.GEOJSON_DATA = <?= json_encode($geojson ?? []) ?>;
        window.FOTO_SEKOLAH_URL = '<?= base_url('uploads/sekolah') ?>';
        window.SEKOLAH_DETAIL_URL = "<?= base_url('sekolah/') ?>";
    </script>

    <!-- Baru load script.js -->
    <script>
        const BASE_URL = '<?= base_url() ?>';
        const FOTO_BASE_URL = '<?= base_url('uploads/sekolah') ?>';
        const SEKOLAH_DATA = <?= json_encode($sekolah ?? []) ?>;
        const GEOJSON_DATA = <?= json_encode($geojson ?? []) ?>;
        const SEKOLAH_DETAIL_URL = '<?= base_url('sekolah/') ?>';
    </script>
    <script src="<?= base_url('assets/js/fullmaps/script.js') ?>"></script>

</body>

</html>