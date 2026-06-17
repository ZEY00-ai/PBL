<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <div class="page-container">

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Edit Data Sekolah</h1>
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

                    <form action="<?= base_url('admin/sekolah/update/' . $sekolah['id']) ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Nama Sekolah -->
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text"
                                name="nama_sekolah"
                                class="form-control"
                                value="<?= old('nama_sekolah', $sekolah['nama_sekolah']) ?>"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold">Tingkatan Sekolah</label>
                            <select name="tingkatan" class="form-select" required>
                                <option value="" disabled>-- Pilih Tingkatan --</option>
                                <option value="TK" <?= old('tingkatan', $sekolah['tingkatan']) === 'TK'  ? 'selected' : '' ?>>TK</option>
                                <option value="SD" <?= old('tingkatan', $sekolah['tingkatan']) === 'SD'  ? 'selected' : '' ?>>SD</option>
                                <option value="SMP" <?= old('tingkatan', $sekolah['tingkatan']) === 'SMP' ? 'selected' : '' ?>>SMP</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold">Akreditasi</label>
                            <select name="akreditasi" class="form-select">
                                <option value="" disabled>-- Pilih Akreditasi --</option>
                                <option value="A" <?= old('akreditasi', $sekolah['akreditasi']) === 'A'                   ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= old('akreditasi', $sekolah['akreditasi']) === 'B'                   ? 'selected' : '' ?>>B</option>
                                <option value="C" <?= old('akreditasi', $sekolah['akreditasi']) === 'C'                   ? 'selected' : '' ?>>C</option>
                                <option value="Belum Terakreditasi" <?= old('akreditasi', $sekolah['akreditasi']) === 'Belum Terakreditasi' ? 'selected' : '' ?>>Belum Terakreditasi</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>NPSN</label>
                            <input type="text" name="npsn" class="form-control"
                                placeholder="Nomor Pokok Sekolah Nasional"
                                value="<?= old('npsn') ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <!-- PETA + KOORDINAT -->
                        <div class="row mb-4">

                            <!-- PETA -->
                            <div class="col-lg-7">

                                <div class="m-card" style="padding:0; overflow:hidden;">
                                    <div id="map" style="height:290px; width:100%;"></div>
                                </div>

                            </div>

                            <!-- KOORDINAT -->
                            <div class="col-lg-5">

                                <div class="card shadow-sm">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text"
                                                id="latitude"
                                                name="latitude"
                                                class="form-control"
                                                value="<?= old('latitude', $sekolah['latitude']) ?>"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text"
                                                id="longitude"
                                                name="longitude"
                                                class="form-control"
                                                value="<?= old('longitude', $sekolah['longitude']) ?>"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text"
                                                id="kecamatan"
                                                name="kecamatan"
                                                class="form-control"
                                                value="<?= old('kecamatan', $sekolah['kecamatan']) ?>"
                                                required>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- ALAMAT -->
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="4"
                                required><?= old('alamat', $sekolah['alamat']) ?></textarea>
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

                        <!-- FOTO -->
                        <div class="form-group">

                            <label>Foto Sekolah</label>

                            <?php if (!empty($sekolah['foto'])): ?>

                                <div class="mb-2">
                                    <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                                        width="150"
                                        style="border-radius:8px; object-fit:cover;">
                                </div>

                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti foto.
                                </small>

                            <?php endif; ?>

                            <input type="file"
                                name="foto"
                                class="form-control mt-2"
                                accept="image/*">

                        </div>

                        <!-- TOMBOL -->
                        <div class="form-group mt-4">

                            <button type="submit"
                                class="btn btn-primary">
                                Update
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

    <!-- Data koordinat lama untuk marker -->
    <script>
        window.editLatitude = "<?= $sekolah['latitude'] ?>";
        window.editLongitude = "<?= $sekolah['longitude'] ?>";
    </script>

    <!-- Script peta -->
    <script src="<?= base_url('assets/js/edit_sekolah.js') ?>"></script>

    <?php echo view('control-panel/components/footer'); ?>

</body>