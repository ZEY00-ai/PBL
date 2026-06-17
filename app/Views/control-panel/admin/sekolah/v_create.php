<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Tambah Data Sekolah</h1>
                            <p class="subtitle">Halaman Tambah Data Sekolah</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/sekolah/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Nama Sekolah -->
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text"
                                name="nama_sekolah"
                                class="form-control"
                                value="<?= old('nama_sekolah') ?>"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold">Tingkatan Sekolah</label>
                            <select name="tingkatan" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Tingkatan --</option>
                                <option value="TK" <?= old('tingkatan') === 'TK'  ? 'selected' : '' ?>>TK</option>
                                <option value="SD" <?= old('tingkatan') === 'SD'  ? 'selected' : '' ?>>SD</option>
                                <option value="SMP" <?= old('tingkatan') === 'SMP' ? 'selected' : '' ?>>SMP</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold">Akreditasi</label>
                            <select name="akreditasi" class="form-select">
                                <option value="" disabled selected>-- Pilih Akreditasi --</option>
                                <option value="A" <?= old('akreditasi') === 'A'                   ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= old('akreditasi') === 'B'                   ? 'selected' : '' ?>>B</option>
                                <option value="C" <?= old('akreditasi') === 'C'                   ? 'selected' : '' ?>>C</option>
                                <option value="Belum Terakreditasi" <?= old('akreditasi') === 'Belum Terakreditasi' ? 'selected' : '' ?>>Belum Terakreditasi</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>NPSN</label>
                            <input type="text" name="npsn" class="form-control"
                                placeholder="Nomor Pokok Sekolah Nasional"
                                value="<?= old('npsn') ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <!-- Peta Kiri & Koordinat Kanan -->
                        <div class="row mb-4">

                            <!-- PETA -->
                            <div class="col-lg-7">
                                <div class="m-card" style="padding:0; overflow:hidden;">
                                    <div id="map" style="height:290px; width:100%;"></div>
                                </div>

                                <!-- Legenda -->
                                <?php if (!empty($geojson)): ?>
                                    <div class="m-card" style="margin-top:15px;">
                                        <div class="m-card__header">
                                            <h2 class="m-card__title">Legenda Kecamatan</h2>
                                        </div>

                                        <div style="display:flex; flex-wrap:wrap; gap:12px; padding:12px;">
                                            <?php foreach ($geojson as $g): ?>
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <div style="
                                                        width:20px;
                                                        height:20px;
                                                        background:<?= esc($g['warna']) ?>;
                                                        border-radius:4px;
                                                        opacity:0.8;">
                                                    </div>

                                                    <span><?= esc($g['nama_kecamatan']) ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- FORM KOORDINAT -->
                            <div class="col-lg-5">
                                <div class="card shadow-sm">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text"
                                                id="latitude"
                                                name="latitude"
                                                class="form-control"
                                                placeholder="-0.123456"
                                                value="<?= old('latitude') ?>"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text"
                                                id="longitude"
                                                name="longitude"
                                                class="form-control"
                                                placeholder="100.123456"
                                                value="<?= old('longitude') ?>"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text"
                                                id="kecamatan"
                                                name="kecamatan"
                                                class="form-control"
                                                value="<?= old('kecamatan') ?>"
                                                required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat"
                                class="form-control"
                                rows="4"
                                required><?= old('alamat') ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control"
                                placeholder="Contoh: 1995" min="1900" max="<?= date('Y') ?>"
                                value="<?= old('tahun_berdiri') ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Website</label>
                            <input type="url" name="website" class="form-control"
                                placeholder="https://www.sekolah.sch.id"
                                value="<?= old('website') ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <!-- Foto Sekolah -->
                        <div class="form-group">
                            <label>Foto Sekolah</label>
                            <input type="file"
                                name="foto"
                                class="form-control"
                                accept="image/*">
                        </div>

                        <!-- Tombol -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>

                            <a href="<?= base_url('admin/sekolah') ?>"
                                class="btn btn-secondary">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </main>
    </div>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <?php echo view('control-panel/components/footer'); ?>

</body>

</html>