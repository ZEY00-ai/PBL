<?php echo view('components/header'); ?>

<body class="app">
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- ==========================================
                         ALERT NOTIFICATION SYSTEM
                         ========================================== -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success shadow-sm" style="border-radius: 8px;"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success_foto')): ?>
                        <div class="alert alert-success shadow-sm" style="border-radius: 8px;"><?= session()->getFlashdata('success_foto') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success_password')): ?>
                        <div class="alert alert-success shadow-sm" style="border-radius: 8px;"><?= session()->getFlashdata('success_password') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error_password')): ?>
                        <div class="alert alert-danger shadow-sm" style="border-radius: 8px;"><?= session()->getFlashdata('error_password') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger shadow-sm" style="border-radius: 8px;">
                            <ul class="mb-0 py-1">
                                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors_password')): ?>
                        <div class="alert alert-danger shadow-sm" style="border-radius: 8px;">
                            <ul class="mb-0 py-1">
                                <?php foreach (session()->getFlashdata('errors_password') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- ==========================================
                         PAGE HEADER
                         ========================================== -->
                    <div class="page-header mb-4">
                        <div>
                            <h1 class="h3 mb-1 text-dark fw-bold">Account &amp; Settings</h1>
                            <p class="text-muted small">Manage your profile information and security credentials.</p>
                        </div>
                    </div>

                    <!-- ==========================================
                         NAVIGATION TABS
                         ========================================== -->
                    <ul class="nav nav-tabs settings-tabs mb-4" role="tablist" style="border-bottom: 1px solid var(--m-divider);">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-4 py-2" data-bs-toggle="tab" data-bs-target="#tab-account" type="button" role="tab">
                                <i class="fa-solid fa-user me-2"></i> Account
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-2" data-bs-toggle="tab" data-bs-target="#tab-security" type="button" role="tab">
                                <i class="fa-solid fa-shield-halved"></i> Security
                            </button>
                        </li>
                    </ul>

                    <!-- ==========================================
                         TAB CONTENT
                         ========================================== -->
                    <div class="tab-content">

                        <!-- TAB 1: ACCOUNT DETAILS (MODERN SaaS VERSION) -->
                        <div class="tab-pane fade show active" id="tab-account" role="tabpanel">
                            <div class="row g-4 align-items-stretch">

                                <!-- Sisi Kiri: Foto Profil Modern -->
                                <div class="col-lg-4 col-xl-3">
                                    <section class="card border-0 h-100 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                                        <div class="card-body d-flex flex-column align-items-center p-4">
                                            <div class="text-center w-100 mb-4">
                                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Profile Photo</h5>
                                                <p class="text-muted small mb-0">PNG, JPG up to 2MB</p>
                                            </div>

                                            <form action="<?= base_url('admin/profile/foto') ?>" method="post" enctype="multipart/form-data" id="form-foto" class="w-100 d-flex flex-column align-items-center">
                                                <?= csrf_field() ?>

                                                <!-- Wrapper Avatar dengan Tombol Hover -->
                                                <div class="position-relative profile-avatar-wrapper mb-4">
                                                    <img src="<?= (!empty($user['foto_profil'])) ? base_url('uploads/profil/' . $user['foto_profil']) : base_url('CoolAdmin-master/images/icon/avatar-01.jpg') ?>"
                                                        alt="Avatar"
                                                        id="preview-foto"
                                                        class="rounded-circle img-thumbnail p-1 shadow-sm"
                                                        style="width: 140px; height: 140px; object-fit: cover; border-color: #f1f5f9;">

                                                    <!-- Badges Kamera Kecil Modern -->
                                                    <label for="input-foto" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                                        style="width: 38px; height: 38px; cursor: pointer; border: 3px solid #ffffff; transition: all 0.2s;">
                                                        <i class="fa-solid fa-camera" style="font-size: 0.9rem;"></i>
                                                    </label>
                                                    <input type="file" name="foto_profil" id="input-foto" accept="image/*" style="display: none;">
                                                </div>

                                                <div class="text-center text-muted small px-2">
                                                    Pilih ikon kamera untuk memperbarui foto profil Anda secara instan.
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>

                                <!-- Sisi Kanan: Form Personal Info Modern -->
                                <div class="col-lg-8 col-xl-9">
                                    <section class="card border-0 h-100 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="mb-4">
                                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Personal Information</h5>
                                                    <p class="text-muted small mb-0">Kelola informasi dasar identitas akun administrator Anda.</p>
                                                </div>

                                                <form action="<?= base_url('admin/profile/update') ?>" method="post">
                                                    <?= csrf_field() ?>

                                                    <!-- Form Grid Menyilang (2 Kolom) -->
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-md-6">
                                                            <label for="nama" class="form-label small fw-semibold text-uppercase tracking-wider text-muted mb-2" style="font-size: 0.75rem;">Nama Lengkap</label>
                                                            <input id="nama" type="text" name="nama" class="form-control border-secondary-subtle py-2 px-3 modern-input"
                                                                value="<?= old('nama', $user['nama']) ?>" autocomplete="name" required style="border-radius: 8px;">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="email" class="form-label small fw-semibold text-uppercase tracking-wider text-muted mb-2" style="font-size: 0.75rem;">Email Address</label>
                                                            <input id="email" type="email" name="email" class="form-control border-secondary-subtle py-2 px-3 modern-input"
                                                                value="<?= old('email', $user['email']) ?>" autocomplete="email" required style="border-radius: 8px;">
                                                        </div>
                                                    </div>

                                                    <hr class="text-black-50 my-4" style="opacity: 0.1;">

                                                    <div class="d-flex justify-content-start">
                                                        <button type="submit" class="m-btn m-btn--primary px-4 py-2 d-inline-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                                                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>

                        <!-- TAB 2: SECURITY SETTINGS -->
                        <div class="tab-pane fade" id="tab-security" role="tabpanel">
                            <div class="row g-4 align-items-stretch">

                                <!-- Form Update Password -->
                                <div class="col-lg-7">
                                    <section class="card border-0 h-100 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Change Password</h5>
                                                <p class="text-muted small mb-0">Amankan akun Anda dengan menggunakan kredensial password yang kuat.</p>
                                            </div>

                                            <form action="<?= base_url('admin/profile/password') ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label small fw-semibold text-muted mb-2" style="font-size: 0.8rem;">Current Password</label>
                                                    <input id="current_password" type="password" name="current_password" class="form-control border-secondary-subtle py-2 modern-input" required style="border-radius: 8px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new_password" class="form-label small fw-semibold text-muted mb-2" style="font-size: 0.8rem;">New Password</label>
                                                    <input id="new_password" type="password" name="new_password" class="form-control border-secondary-subtle py-2 modern-input" required style="border-radius: 8px;">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="confirm_password" class="form-label small fw-semibold text-muted mb-2" style="font-size: 0.8rem;">Confirm New Password</label>
                                                    <input id="confirm_password" type="password" name="confirm_password" class="form-control border-secondary-subtle py-2 modern-input" required style="border-radius: 8px;">
                                                </div>
                                                <button type="submit" class="m-btn m-btn--primary px-4 py-2" style="border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                                                    <i class="fa-solid fa-lock me-2"></i> Update Password
                                                </button>
                                            </form>
                                        </div>
                                    </section>
                                </div>

                                <!-- Password Security Guidelines -->
                                <div class="col-lg-5">
                                    <section class="card border-0 h-100 shadow-sm" style="border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0 !important;">
                                        <div class="card-body p-4">
                                            <div class="mb-3">
                                                <h6 class="fw-bold text-uppercase tracking-wider text-muted small" style="font-size: 0.75rem;">Password Security Tips</h6>
                                            </div>
                                            <ul class="text-secondary ps-3 mb-0 small" style="line-height: 2.2; font-size: 0.85rem;">
                                                <li>Gunakan minimal <strong class="text-dark">6 karakter</strong> atau lebih.</li>
                                                <li>Kombinasikan karakter <strong class="text-dark">Huruf Besar &amp; Kecil</strong>.</li>
                                                <li>Sisipkan minimal satu <strong class="text-dark">Angka (0-9)</strong> atau <strong class="text-dark">Simbol khusus (@, #, $, dll)</strong>.</li>
                                                <li>Hindari penggunaan kata sandi generik yang mudah ditebak (*123456*, *admin*).</li>
                                            </ul>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="copyright text-muted small py-3" style="border-top: 1px solid var(--m-divider);">
                                <p>&copy; 2026 Colorlib. All rights reserved. Built with precision.</p>
                            </div>
                        </div>
                    </div>

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

                // Efek loading opacity saat otomatis tersubmit
                this.closest('form').style.opacity = '0.5';
                document.getElementById('form-foto').submit();
            }
        });
    </script>

    <style>
        .theme-switcher {
            display: none !important;
        }

        /* Efek Hover Interaktif Pada Tombol Kamera */
        .profile-avatar-wrapper label:hover {
            transform: scale(1.1);
            background-color: #1d4ed8 !important;
        }

        /* Desain Modern untuk Input Form */
        .modern-input {
            transition: all 0.2s ease-in-out;
            background-color: #fdfdfd;
        }

        .modern-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
            background-color: #ffffff;
        }

        /* Utilitas Perataan Sejajar */
        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .align-items-stretch .card {
            height: 100%;
        }
    </style>
</body> 