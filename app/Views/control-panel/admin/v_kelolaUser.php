<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>

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
                                <a href="#" class="m-btn m-btn--primary">
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
                                        <tr>
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
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= esc($g['nama']) ?></td>
                                                    <td><?= esc($g['email']) ?></td>
                                                    <td><?= esc($g['role']) ?></td>
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