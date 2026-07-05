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
                                    <div class="foto-upload-wrap">
                                        <div class="foto-preview-box">
                                            <img id="preview-foto"
                                                src="<?= $sekolah['foto'] ? base_url('uploads/sekolah/' . $sekolah['foto']) : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                                alt="Foto Sekolah">

                                            <label for="input-foto" class="foto-overlay">
                                                <i class="fa-solid fa-camera"></i>
                                                <span>Ganti Foto</span>
                                            </label>
                                        </div>

                                        <input type="file" name="foto" id="input-foto" accept="image/*" hidden>

                                        <label for="input-foto" class="foto-btn">
                                            <i class="fa-solid fa-upload"></i> Pilih Foto
                                        </label>

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
                                    <small class="text-muted">Hubungi Super Admin untuk mengubah</small>
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

                                <!-- <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" required><?= esc($sekolah['alamat']) ?></textarea>
                                </div> -->

                                <!-- <div class="row row-tight mb-3">
                                    <div class="col-md-6">
                                        <label>Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" value="<?= esc($sekolah['latitude']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" value="<?= esc($sekolah['longitude']) ?>" required>
                                    </div>
                                </div> -->

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

                                <div style="display:flex; align-items:center; gap:10px;">
                                    <button type="submit" form="form-utama" class="m-btn m-btn--primary">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan perubahan
                                    </button>

                                    <a href="<?= base_url('admin/profileSekolah') ?>" class="m-btn m-btn--ghost">
                                        <i class="fa-solid fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
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

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* ===== Foto Upload ===== */
        .foto-upload-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .foto-preview-box {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e5e9f0;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
        }

        .foto-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease;
        }

        .foto-preview-box:hover img {
            transform: scale(1.05);
        }

        .foto-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            opacity: 0;
            cursor: pointer;
            transition: opacity .25s ease;
        }

        .foto-overlay i {
            font-size: 20px;
        }

        .foto-preview-box:hover .foto-overlay {
            opacity: 1;
        }

        .foto-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbe6fb;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
            width: 100%;
            justify-content: center;
        }

        .foto-btn:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
    </style>
</body>