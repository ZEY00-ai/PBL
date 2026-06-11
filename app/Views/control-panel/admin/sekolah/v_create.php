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

                    <form action="<?= base_url('operator-maps/sekolah/') ?>" method="post" enctype="multipart/form-data">
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

                            <a href="<?= base_url('operator-maps/sekolah') ?>"
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