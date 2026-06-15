<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('control-panel/components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Profile</h1>
                            <p class="subtitle">Informasi akun admin</p>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success_foto')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success_foto') ?></div>
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

                    <div class="m-card">

                        <!-- Bagian Atas: Foto + Info -->
                        <div style="display:flex; gap:32px; padding:32px; border-bottom:1px solid var(--m-divider); align-items:center; flex-wrap:wrap;">

                            <!-- Foto Profil -->
                            <div style="flex-shrink:0; text-align:center;">
                                <img src="<?= (!empty($user['foto_profil']))
                                                ? base_url('uploads/profil/' . $user['foto_profil'])
                                                : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                    alt="Foto Profil"
                                    id="preview-foto"
                                    style="width:130px; height:130px; border-radius:50%; object-fit:cover; border:4px solid var(--m-accent); box-shadow:0 4px 20px rgba(0,0,0,0.12); display:block; margin:0 auto 12px;">

                                <!-- Upload foto -->
                                <form action="<?= base_url('admin/profile/foto') ?>" method="post" enctype="multipart/form-data" id="form-foto">
                                    <?= csrf_field() ?>
                                    <label for="input-foto" style="cursor:pointer; font-size:12px; color:var(--m-accent); display:block; margin-bottom:6px;">
                                        <i class="fa-solid fa-camera"></i> Ganti Foto
                                    </label>
                                    <input type="file" name="foto_profil" id="input-foto" accept="image/*" style="display:none;" onchange="document.getElementById('form-foto').submit()">
                                </form>
                            </div>

                            <!-- Info Admin -->
                            <div style="flex:1; min-width:200px;">
                                <table style="width:100%; border-collapse:collapse;">
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:12px 0; color:var(--m-text-muted); width:120px;">
                                            <i class="fa-solid fa-user"></i> Nama
                                        </td>
                                        <td style="padding:12px 0; font-weight:600; font-size:15px;">
                                            <?= esc($user['nama']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:12px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-envelope"></i> Email
                                        </td>
                                        <td style="padding:12px 0;">
                                            <?= esc($user['email']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-shield"></i> Role
                                        </td>
                                        <td style="padding:12px 0;">
                                            <span style="display:inline-block; padding:3px 12px; border-radius:20px; font-size:12px; font-weight:600; background:var(--m-accent-soft, #eef2ff); color:var(--m-accent);">
                                                Admin
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <!-- Bagian Bawah: Edit Profile -->
                        <div style="padding:32px;">
                            <h2 class="m-card__title" style="margin-bottom:20px;">
                                <i class="fa-solid fa-pen"></i> Edit Profile
                            </h2>

                            <form action="<?= base_url('admin/profile/update') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row row-tight">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="<?= old('nama', $user['nama']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?= old('email', $user['email']) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:8px;">
                                    <button type="submit" class="m-btn m-btn--primary">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

    <?php echo view('control-panel/components/footer'); ?>
    <script>
        // Preview foto sebelum upload
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