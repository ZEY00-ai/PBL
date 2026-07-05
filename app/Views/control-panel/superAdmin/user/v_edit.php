<?php echo view('components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Edit Akun</h1>
                            <p class="subtitle">Ubah data akun pengguna</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('superAdmin/user/list') ?>" class="m-btn m-btn--ghost">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
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
                        <form action="<?= base_url('superAdmin/user/update/' . $user['id']) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group mb-3">
                                <label class="fw-semibold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control"
                                    placeholder="Masukkan nama lengkap"
                                    value="<?= old('nama', $user['nama']) ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="contoh@email.com"
                                    value="<?= old('email', $user['email']) ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="fw-semibold">Password Baru</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                <small class="text-muted">Minimal 6 karakter. Biarkan kosong jika tidak ingin mengganti password.</small>
                            </div>

                            <div class="form-group mb-4">
                                <label class="fw-semibold">Konfirmasi Password Baru</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="Ulangi password baru">
                            </div>

                            <div style="display:flex; gap:8px;">
                                <button type="submit" class="m-btn m-btn--primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('superAdmin/user/list') ?>" class="m-btn m-btn--ghost">Batal</a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('components/footer'); ?>
</body>