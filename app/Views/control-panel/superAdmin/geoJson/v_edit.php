<!DOCTYPE html>
<html lang="en">

<?php echo view('components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="page-header">
                    <div>
                        <h1>Edit Data GeoJson</h1>
                        <p class="subtitle">Halaman Edit Data GeoJson</p>
                        <div style="margin-top:12px; padding:10px 12px; background:#fef3c7; border-left:4px solid #f59e0b; border-radius:4px; font-size:13px; color:#92400e;">
                            <i class="fa-solid fa-info-circle"></i> Hanya boleh 1 GeoJson per kecamatan. Jika mengubah nama kecamatan, pastikan tidak duplikat dengan data lain.
                        </div>
                    </div>
                </div>
                <form action="<?= base_url('superAdmin/geojson/update/' . $geojson['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Nama Kecamatan</label>
                        <input type="text" name="nama_kecamatan" class="form-control"
                            value="<?= old('nama_kecamatan', $geojson['nama_kecamatan']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Warna Wilayah</label>
                        <input type="color" name="warna" class="form-control"
                            value="<?= old('warna', $geojson['warna']) ?>"
                            style="width:100px; height:100px;">
                    </div>

                    <div class="form-group">
                        <label>GeoJSON</label>
                        <textarea name="geojson" class="form-control" rows="10"
                            placeholder='Paste GeoJSON di sini'
                            required><?= old('geojson', $geojson['geojson']) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('superAdmin/geojson/list') ?>"
                        class="btn btn-secondary">
                        Batal
                    </a>
                </form>
            </div>
        </main>
    </div>
    <?php echo view('components/footer'); ?>
</body>

</html>