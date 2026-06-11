<?php echo view('control-panel/components/header'); ?>

<body class="app">
<div class="page-container">
    <main class="main-content" id="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="page-header">
                    <div>
                        <h1>List GeoJSON</h1>
                        <p class="subtitle">Daftar data wilayah kecamatan</p>
                    </div>
                    <div class="page-header__actions">
                        <a href="<?= base_url('operator-maps/input-geojson') ?>" class="m-btn m-btn--primary">
                            <i class="fa-solid fa-plus"></i> Tambah GeoJSON
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <div class="m-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Warna</th>
                                    <th>GeoJSON</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($geojson)): ?>
                                    <?php foreach ($geojson as $i => $g): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= esc($g['nama_kecamatan']) ?></td>
                                            <td>
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <div style="width:30px; height:30px; background:<?= esc($g['warna']) ?>; border-radius:6px;"></div>
                                                    <small><?= esc($g['warna']) ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted" style="max-width:200px; display:block; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                                                    <?= esc(substr($g['geojson'], 0, 80)) ?>...
                                                </small>
                                            </td>
                                            <td>
                                                <small><?= $g['created_at'] ?></small>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('operator-maps/geojson/edit/' . $g['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>
                                                <a href="<?= base_url('operator-maps/geojson/hapus/' . $g['id']) ?>"
                                                    class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px; color:red;"
                                                    onclick="return confirm('Yakin hapus data kecamatan <?= esc($g['nama_kecamatan']) ?>?')">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data GeoJSON.</td>
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