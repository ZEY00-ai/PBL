<?php echo view('components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">

        <?php echo view('components/sidebar'); ?>

        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="page-header">
                        <div>
                            <h1>Detail Akun</h1>
                            <p class="subtitle">Informasi lengkap akun pengguna</p>
                        </div>
                        <div class="page-header__actions">
                            <a href="<?= base_url('superAdmin/user/list') ?>" class="m-btn m-btn--ghost">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row row-tight">

                        <!-- Kolom Kiri: Foto Profil -->
                        <div class="col-lg-4">
                            <div class="m-card" style="text-align:center; padding:32px 20px;">

                                <!-- Foto Profil Bulat -->
                                <?php if (!empty($user['foto_profil'])): ?>
                                    <img src="<?= base_url('uploads/profil/' . $user['foto_profil']) ?>"
                                        alt="Foto Profil"
                                        style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid var(--m-accent); box-shadow:0 4px 20px rgba(0,0,0,0.12);">
                                <?php else: ?>
                                    <!-- Avatar default dengan inisial nama -->
                                    <div style="width:120px; height:120px; border-radius:50%; background:var(--m-accent); display:inline-flex; align-items:center; justify-content:center; border:4px solid var(--m-accent); box-shadow:0 4px 20px rgba(0,0,0,0.12);">
                                        <span style="font-size:42px; font-weight:700; color:#fff;">
                                            <?= strtoupper(substr($user['nama'], 0, 1)) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <h3 style="margin-top:16px; margin-bottom:4px; font-weight:700;">
                                    <?= esc($user['nama']) ?>
                                </h3>
                                <p style="color:var(--m-text-muted); font-size:13px; margin:0;">
                                    <?= esc($user['email']) ?>
                                </p>

                                <div style="margin-top:20px; padding-top:20px; border-top:1px solid var(--m-divider);">
                                    <span style="display:inline-block; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:600; background:var(--m-success-soft); color:var(--m-success);">
                                        <i class="fa-solid fa-circle" style="font-size:8px;"></i> <?= esc($user['role']) ?>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <!-- Kolom Kanan: Info Detail -->
                        <div class="col-lg-8">
                            <div class="m-card">
                                <div class="m-card__header">
                                    <div>
                                        <h2 class="m-card__title">Informasi Akun</h2>
                                        <p class="m-card__subtitle">Data lengkap pengguna</p>
                                    </div>
                                </div>

                                <table style="width:100%; border-collapse:collapse;">
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:14px 0; color:var(--m-text-muted); width:35%;">
                                            <i class="fa-solid fa-user"></i> Nama
                                        </td>
                                        <td style="padding:14px 0; font-weight:600;">
                                            <?= esc($user['nama']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:14px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-envelope"></i> Email
                                        </td>
                                        <td style="padding:14px 0;">
                                            <?= esc($user['email']) ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid var(--m-divider);">
                                        <td style="padding:14px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-calendar"></i> Dibuat
                                        </td>
                                        <td style="padding:14px 0;">
                                            <?= $user['created_at'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:14px 0; color:var(--m-text-muted);">
                                            <i class="fa-solid fa-clock"></i> Diupdate
                                        </td>
                                        <td style="padding:14px 0;">
                                            <?= $user['updated_at'] ?? '-' ?>
                                        </td>
                                    </tr>
                                </table>

                                <!-- <div style="margin-top:24px; display:flex; gap:8px;">
                                    <a href="<?= base_url('user/delete/' . $user['id']) ?>"
                                        class="m-btn m-btn--ghost" style="color:red;"
                                        onclick="return confirm('Yakin hapus akun <?= esc($user['nama']) ?>?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </div> -->

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

</body>