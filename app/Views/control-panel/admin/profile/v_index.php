<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <div class="page-container">

        <?php echo view('control-panel/components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- ALERT -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success_foto')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success_foto') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success_password')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success_password') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error_password')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error_password') ?></div>
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

                    <?php if (session()->getFlashdata('errors_password')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors_password') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h1>Account &amp; Settings</h1>
                            <p class="subtitle">Manage your profile and security.</p>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs settings-tabs" role="tablist"
                        style="border-bottom:1px solid var(--m-divider); margin-bottom:24px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-account"
                                type="button" role="tab">
                                <i class="fa-solid fa-user"></i> Account
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-security"
                                type="button" role="tab">
                                <i class="fa-solid fa-shield-halved"></i> Security
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <!-- ACCOUNT TAB -->
                        <div class="tab-pane fade show active" id="tab-account" role="tabpanel">
                            <div class="row row-tight">

                                <!-- Kolom Kiri: Foto + Language -->
                                <div class="col-lg-4">

                                    <!-- Foto Profil -->
                                    <section class="m-card">
                                        <header class="m-card__header">
                                            <div>
                                                <h2 class="m-card__title">Profile photo</h2>
                                                <p class="m-card__subtitle">JPG, PNG or GIF, up to 2 MB.</p>
                                            </div>
                                        </header>
                                        <form action="<?= base_url('admin/profile/foto') ?>" method="post" enctype="multipart/form-data" id="form-foto">
                                            <?= csrf_field() ?>
                                            <div style="display:flex; flex-direction:column; align-items:center; gap:16px; padding:8px 0;">
                                                <img src="<?= (!empty($user['foto_profil']))
                                                                ? base_url('uploads/profil/' . $user['foto_profil'])
                                                                : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                                    alt="Foto Profil"
                                                    id="preview-foto"
                                                    style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid var(--m-surface); box-shadow:0 4px 16px rgba(15,23,42,0.10);">
                                                <div style="display:flex; gap:8px;">
                                                    <label for="input-foto" class="m-btn m-btn--primary" style="cursor:pointer; margin:0; display:inline-flex; align-items:center; justify-content:center; gap:8px;">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload
                                                    </label>
                                                    <input type="file" name="foto_profil" id="input-foto" accept="image/*" style="display:none;">
                                                </div>
                                            </div>
                                        </form>
                                    </section>

                                    <!-- Language -->
                                    <section class="m-card" style="margin-top:16px;">
                                        <header class="m-card__header">
                                            <div>
                                                <h2 class="m-card__title">Language</h2>
                                            </div>
                                        </header>
                                        <ul class="card-list" style="margin:0 -20px -8px;">
                                            <li>
                                                <div class="card-list__main">
                                                    <span class="card-list__icon" style="background:#f4f6fa; color:#1f2937;">
                                                        <i class="fa-solid fa-globe"></i>
                                                    </span>
                                                    <div>
                                                        <span class="card-list__title">English</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="m-btn m-btn--ghost"
                                                    style="height:30px; padding:0 12px; font-size:12.5px;">used</button>
                                            </li>
                                            <li>
                                                <div class="card-list__main">
                                                    <span class="card-list__icon" style="background:#f4f6fa; color:#1f2937;">
                                                        <i class="fa-solid fa-flag"></i>
                                                    </span>
                                                    <div>
                                                        <span class="card-list__title">Indonesia</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="m-btn m-btn--ghost"
                                                    style="height:30px; padding:0 12px; font-size:12.5px;">use</button>
                                            </li>
                                        </ul>
                                    </section>

                                </div>

                                <!-- Kolom Kanan: Personal Information -->
                                <div class="col-lg-8">
                                    <section class="m-card">
                                        <header class="m-card__header">
                                            <div>
                                                <h2 class="m-card__title">Personal information</h2>
                                                <p class="m-card__subtitle">Update nama dan email akun kamu.</p>
                                            </div>
                                        </header>
                                        <form action="<?= base_url('admin/profile/update') ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="form-group mb-3">
                                                <label for="nama">Nama</label>
                                                <input id="nama" type="text" name="nama" class="form-control"
                                                    value="<?= old('nama', $user['nama']) ?>"
                                                    autocomplete="name" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email">Email address</label>
                                                <input id="email" type="email" name="email" class="form-control"
                                                    value="<?= old('email', $user['email']) ?>"
                                                    autocomplete="email" required>
                                            </div>
                                            <button type="submit" class="m-btn m-btn--primary">
                                                <i class="fa-solid fa-floppy-disk"></i> Save changes
                                            </button>
                                        </form>
                                    </section>
                                </div>

                            </div>
                        </div>

                        <!-- SECURITY TAB -->
                        <div class="tab-pane fade" id="tab-security" role="tabpanel">
                            <div class="row row-tight">

                                <!-- Form Ganti Password -->
                                <div class="col-lg-7">
                                    <section class="m-card">
                                        <header class="m-card__header">
                                            <div>
                                                <h2 class="m-card__title">Change password</h2>
                                                <p class="m-card__subtitle">Use at least 6 characters.</p>
                                            </div>
                                        </header>
                                        <form action="<?= base_url('admin/profile/password') ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="form-group mb-3">
                                                <label for="current_password">Current password</label>
                                                <input id="current_password" type="password" name="current_password"
                                                    class="form-control" autocomplete="current-password" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="new_password">New password</label>
                                                <input id="new_password" type="password" name="new_password"
                                                    class="form-control" autocomplete="new-password" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="confirm_password">Confirm new password</label>
                                                <input id="confirm_password" type="password" name="confirm_password"
                                                    class="form-control" autocomplete="new-password" required>
                                            </div>
                                            <button type="submit" class="m-btn m-btn--primary">
                                                <i class="fa-solid fa-lock"></i> Update Password
                                            </button>
                                        </form>
                                    </section>
                                </div>

                                <!-- Password Tips -->
                                <div class="col-lg-5">
                                    <section class="m-card">
                                        <header class="m-card__header">
                                            <h2 class="m-card__title">Password Tips</h2>
                                        </header>
                                        <ul style="margin:0; padding-left:18px; line-height:2;">
                                            <li>Gunakan minimal 6 karakter</li>
                                            <li>Campur huruf besar &amp; kecil</li>
                                            <li>Tambahkan angka dan simbol</li>
                                            <li>Jangan gunakan password yang sama</li>
                                        </ul>
                                    </section>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Copyright -->
                    <div class="row" style="margin-top:28px;">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2026 Colorlib. All rights reserved. Template by
                                    <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('control-panel/components/footer'); ?>
    <script>
        document.getElementById('input-foto').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-foto').src = e.target.result;
                };
                reader.readAsDataURL(file);
                document.getElementById('form-foto').submit();
            }
        });
    </script>
    <style>
        .theme-switcher {
            display: none !important;
        }
    </style>
</body>