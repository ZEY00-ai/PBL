<?php echo view('components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Profil sekolah</h1>
                            <p class="subtitle"><?= esc($sekolah['nama_sekolah']) ?> &middot; NPSN <?= esc($sekolah['npsn'] ?? '-') ?></p>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
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

                    <div class="row row-tight">

                        <!-- Foto Sekolah -->
                        <div class="col-lg-4">
                            <section class="m-card">
                                <header class="m-card__header">
                                    <h2 class="m-card__title">Foto sekolah</h2>
                                </header>
                                <form action="<?= base_url('admin/profileSekolah/update') ?>" method="post" enctype="multipart/form-data" id="form-utama">
                                    <?= csrf_field() ?>
                                    <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                        <img id="preview-foto"
                                            src="<?= $sekolah['foto'] ? base_url('uploads/sekolah/' . $sekolah['foto']) : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:10px;">
                                        <input type="file" name="foto" id="input-foto" accept="image/*" style="width:100%;">
                                        <small class="text-muted">JPG atau PNG, maksimal 2MB.</small>
                                    </div>

                                    <hr>

                                    <!-- Form Profile dilanjutkan di kolom kanan, tapi tetap dalam form yang sama -->
                                    <div style="display:none;"></div>
                            </section>
                        </div>

                        <!-- Form Profile -->
                        <div class="col-lg-8">
                            <section class="m-card">
                                <header class="m-card__header">
                                    <h2 class="m-card__title">Informasi sekolah</h2>
                                </header>

                                <div class="form-group mb-3">
                                    <label>Nama sekolah</label>
                                    <input type="text" class="form-control" value="<?= esc($sekolah['nama_sekolah']) ?>" disabled>
                                    <small class="text-muted">Hubungi Super Admin untuk mengubah nama sekolah.</small>
                                </div>

                                <div class="row row-tight mb-3">
                                    <div class="col-md-6">
                                        <label>NPSN</label>
                                        <input type="text" class="form-control" value="<?= esc($sekolah['npsn'] ?? '-') ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tingkatan</label>
                                        <input type="text" class="form-control" value="<?= esc($sekolah['tingkatan'] ?? '-') ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fw-semibold">Nama Kepala Sekolah</label>
                                    <input type="text" name="kepala_sekolah" class="form-control"
                                        placeholder="Nama lengkap kepala sekolah"
                                        value="<?= old('kepala_sekolah', $sekolah['kepala_sekolah'] ?? '') ?>">
                                    <small class="text-muted">Opsional</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Akreditasi</label>
                                    <select name="akreditasi" class="form-select">
                                        <option value="" disabled <?= !$sekolah['akreditasi'] ? 'selected' : '' ?>>-- Pilih Akreditasi --</option>
                                        <option value="A" <?= $sekolah['akreditasi'] === 'A' ? 'selected' : '' ?>>A</option>
                                        <option value="B" <?= $sekolah['akreditasi'] === 'B' ? 'selected' : '' ?>>B</option>
                                        <option value="C" <?= $sekolah['akreditasi'] === 'C' ? 'selected' : '' ?>>C</option>
                                        <option value="Belum Terakreditasi" <?= $sekolah['akreditasi'] === 'Belum Terakreditasi' ? 'selected' : '' ?>>Belum Terakreditasi</option>
                                    </select>
                                </div>

                                <div class="row row-tight mb-3">
                                    <div class="col-md-6">
                                        <label>Visi Sekolah</label>
                                        <textarea name="visi" class="form-control" rows="1"><?= old('visi', $sekolah['visi']) ?></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Misi Sekolah</label>
                                        <textarea name="misi" class="form-control" rows="1"><?= old('misi', $sekolah['misi']) ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Kecamatan</label>
                                    <select name="geojson_id" class="form-select" required>
                                        <option value="" disabled>-- Pilih Kecamatan --</option>
                                        <?php foreach ($geojson as $g): ?>
                                            <option value="<?= $g['id'] ?>" <?= $sekolah['geojson_id'] == $g['id'] ? 'selected' : '' ?>>
                                                <?= esc($g['nama_kecamatan']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" required><?= esc($sekolah['alamat']) ?></textarea>
                                </div>

                                <div class="row row-tight mb-3">
                                    <div class="col-md-6">
                                        <label>Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" value="<?= esc($sekolah['latitude']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" value="<?= esc($sekolah['longitude']) ?>" required>
                                    </div>
                                </div>

                                <div class="row row-tight mb-3">
                                    <div class="col-md-6">
                                        <label>Nomor sekolah</label>
                                        <input type="text" name="nomor_sekolah" class="form-control" value="<?= esc($sekolah['nomor_sekolah']) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= esc($sekolah['email']) ?>">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Website</label>
                                    <input type="url" name="website" class="form-control" placeholder="https://www.sekolah.sch.id" value="<?= esc($sekolah['website']) ?>">
                                </div>

                                <button type="submit" form="form-utama" class="m-btn m-btn--primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan perubahan
                                </button>
                            </section>
                        </div>

                    </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('components/footer'); ?>
    <script>
        document.getElementById('input-foto').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-foto').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>