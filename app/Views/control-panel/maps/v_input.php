<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="page-header">
                        <div>
                            <h1>Kelola User</h1>
                            <p class="subtitle">Halaman manajemen pengguna untuk admin sistem</p>
                        </div>
                    </div>
                    <form action="<?= base_url('admin/sekolah/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?= old('nama_sekolah') ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required><?= old('alamat') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" placeholder="-0.123456" value="<?= old('latitude') ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" placeholder="100.123456" value="<?= old('longitude') ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="<?= old('kecamatan') ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Foto Sekolah</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
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

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('admin/sekolah') ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <?php echo view('control-panel/components/footer'); ?>
</body>

</html>