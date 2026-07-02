<?php echo view('components/header'); ?>

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

                    <form action="<?= base_url('superAdmin/sekolah/update/' . $sekolah['id']) ?>"
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
                                value="<?= old('npsn', $sekolah['npsn']) ?>">
                        </div>

                        <div class="row row-tight mb-3">
                            <div class="col-md-6">
                                <label>Visi Sekolah</label>
                                <textarea name="visi" class="form-control" rows="3"><?= old('visi', $sekolah['visi']) ?></textarea>
                            </div>

                            <div class="col-md-6">
                                <label>Misi Sekolah</label> 
                                <textarea name="misi" class="form-control" rows="4"><?= old('misi', $sekolah['misi']) ?></textarea>
                            </div>
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

                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Kecamatan</label>
                                            <select name="geojson_id" class="form-select" required>
                                                <option value="" disabled>-- Pilih Kecamatan --</option>
                                                <?php foreach ($geojson as $g): ?>
                                                    <option value="<?= $g['id'] ?>" <?= $sekolah['geojson_id'] == $g['id'] ? 'selected' : '' ?>>
                                                        <?= esc($g['nama_kecamatan']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
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
                            <label>Nomor Sekolah</label>
                            <input type="text" name="nomor_sekolah" class="form-control"
                                value="<?= old('nomor_sekolah', $sekolah['nomor_sekolah']) ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Email Sekolah</label>
                            <input type="email" name="email" class="form-control"
                                value="<?= old('email', $sekolah['email']) ?>">
                            <small class="text-muted">Opsional</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Website</label>
                            <input type="url" name="website" class="form-control"
                                placeholder="https://www.sekolah.sch.id"
                                value="<?= old('website', $sekolah['website']) ?>">
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

                            <a href="<?= base_url('superAdmin/sekolah') ?>"
                                class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Data koordinat & kecamatan lama untuk marker -->
    <script>
        window.editLatitude = "<?= $sekolah['latitude'] ?>";
        window.editLongitude = "<?= $sekolah['longitude'] ?>";
        window.editGeojsonId = "<?= $sekolah['geojson_id'] ?>";
        const geojsonData = <?= json_encode($geojson ?? []) ?>;
    </script>

    <!-- Script peta -->
    <script src="<?= base_url('assets/js/sekolah/edit_sekolah.js') ?>"></script>

    <?php echo view('components/footer'); ?>

</body>