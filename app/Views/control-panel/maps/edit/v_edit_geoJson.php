<?php echo view('control-panel/components/header'); ?>

<body class="app">
<div class="page-container">
    <main class="main-content" id="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="page-header">
                    <div>
                        <h1>Edit GeoJSON</h1>
                        <p class="subtitle">Ubah data wilayah kecamatan</p>
                    </div>
                </div>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <div class="m-card p-4">
                    <form action="<?= base_url('operator-maps/geojson/update/' . $geojson['id']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label>Nama Kecamatan</label>
                            <input type="text" name="nama_kecamatan" class="form-control"
                                value="<?= old('nama_kecamatan', $geojson['nama_kecamatan']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Warna Wilayah</label>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <input type="color" name="warna" class="form-control"
                                    value="<?= old('warna', $geojson['warna']) ?>"
                                    style="width:80px; height:80px;">
                                <small class="text-muted">Pilih warna untuk wilayah kecamatan ini</small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>GeoJSON</label>
                            <textarea name="geojson" class="form-control" rows="12" required><?= old('geojson', $geojson['geojson']) ?></textarea>
                            <small class="text-muted">Paste data GeoJSON dalam format JSON yang valid.</small>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-floppy-disk"></i> Update
                            </button>
                            <a href="<?= base_url('operator-maps/geojson/list') ?>" class="m-btn m-btn--ghost">Batal</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </main>
</div>

<?php echo view('control-panel/components/footer'); ?>
</body>