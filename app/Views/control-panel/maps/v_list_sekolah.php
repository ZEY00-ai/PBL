<?php echo view('control-panel/components/header'); ?>

<body class="app">
<div class="page-container">
    <main class="main-content" id="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="page-header">
                    <div>
                        <h1>Data Sekolah</h1>
                        <p class="subtitle">Daftar seluruh sekolah di Kabupaten Tanah Datar</p>
                    </div>
                    <div class="page-header__actions">
                        <a href="<?= base_url('admin/sekolah/tambah') ?>" class="m-btn m-btn--primary">
                            <i class="fa-solid fa-plus"></i> Tambah Sekolah
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Tabel Data -->
                <div class="m-card">
                    <div class="m-card__header">
                        <h2 class="m-card__title">Daftar Sekolah</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <th>Koordinat</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sekolah)): ?>
                                    <?php foreach ($sekolah as $i => $s): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= esc($s['nama_sekolah']) ?></td>
                                            <td><?= esc($s['kecamatan']) ?></td>
                                            <td><?= esc($s['alamat']) ?></td>
                                            <td>
                                                <small>
                                                    Lat: <?= $s['latitude'] ?><br>
                                                    Lng: <?= $s['longitude'] ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($s['foto']): ?>
                                                    <img src="<?= base_url('uploads/sekolah/' . $s['foto']) ?>"
                                                        width="60" height="60"
                                                        style="object-fit:cover; border-radius:6px;">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/sekolah/edit/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>
                                                <a href="<?= base_url('admin/sekolah/hapus/' . $s['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px; color:red;"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data sekolah.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<?php echo view('control-panel/components/footer'); ?>
</body>