<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">

    <body class="app">
        <div class="page-container">
            <main class="main-content" id="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="page-header">
                            <div>
                                <h1>Kelola User</h1>
                                <p class="subtitle">Daftar data User</p>
                            </div>
                            <div class="page-header__actions">
                                <a href="<?= base_url('admin/user/create') ?>" class="m-btn m-btn--primary">
                                    <i class="fa-solid fa-plus"></i> Tambah User
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
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($users)): ?>
                                            <?php foreach ($users as $i => $g): ?>
                                                <tr class="text-center">
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= esc($g['nama']) ?></td>
                                                    <td><?= esc($g['email']) ?></td>
                                                    <td>
                                                        <!-- <a href="<?= base_url('geojson/edit/' . $g['id']) ?>"
                                                            class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </a> -->
                                                        <a href="<?= base_url('admin/user/detail/' . $g['id']) ?>"
                                                            class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px;">
                                                            <i class="fa-solid fa-pen"></i> Detail
                                                        </a>
                                                        <a href="<?= base_url('admin/user/hapus/' . $g['id']) ?>"
                                                            class="m-btn m-btn--ghost" style="padding:4px 10px; font-size:12px; color:red;"
                                                            onclick="return confirm('Yakin hapus data kecamatan <?= esc($g['nama']) ?>?')">
                                                            <i class="fa-solid fa-trash"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Belum ada data User.</td>
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

    </body>
    <?php echo view('control-panel/components/footer'); ?>
</body>

</html>