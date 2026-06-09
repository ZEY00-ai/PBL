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
                            <h1>Edit Sekolah</h1>
                            <p class="subtitle">Ubah data sekolah</p>
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

                    <div class="m-card p-4">
                        <form action="<?= base_url('operator-maps/sekolah/update/' . $sekolah['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="form-group mb-3">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control"
                                    value="<?= old('nama_sekolah', $sekolah['nama_sekolah']) ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= old('alamat', $sekolah['alamat']) ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Latitude</label>
                                        <input type="text" name="latitude" class="form-control"
                                            value="<?= old('latitude', $sekolah['latitude']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" class="form-control"
                                            value="<?= old('longitude', $sekolah['longitude']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control"
                                    value="<?= old('kecamatan', $sekolah['kecamatan']) ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Foto Sekolah</label><br>
                                <?php if ($sekolah['foto']): ?>
                                    <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                                        width="120" height="80"
                                        style="object-fit:cover; border-radius:6px; margin-bottom:8px;"><br>
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small><br>
                                <?php endif; ?>
                                <input type="file" name="foto" class="form-control mt-2" accept="image/*">
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="m-btn m-btn--primary">Update</button>
                                <a href="<?= base_url('operator-maps/sekolah') ?>" class="m-btn m-btn--ghost">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php echo view('control-panel/components/footer'); ?>
</body>

</html>