<div class="tab-pane fade show active" id="tab-account" role="tabpanel">
    <div class="row row-tight">
        <div class="col-lg-4">
            <section class="m-card">
                <header class="m-card__header">
                    <div>
                        <h2 class="m-card__title">Profile photo</h2>
                        <p class="m-card__subtitle">JPG, PNG atau GIF, maks 2 MB.</p>
                    </div>
                </header>
                <form action="<?= base_url('operator-maps/profile/update-foto') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div style="display:flex; flex-direction:column; align-items:center; gap:16px; padding:8px 0;">
                        <<img src="<?= (!empty($user['foto_profil']))
                                        ? base_url('uploads/profil/' . $user['foto_profil'])
                                        : base_url('images/icon/avatar-01.jpg') ?>"
                            alt="Foto Profil"
                            style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid var(--m-surface); box-shadow:0 4px 16px rgba(15,23,42,0.10);">
                            <input type="file" name="foto_profil" class="form-control" accept="image/*" required>
                            <button type="submit" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Upload
                            </button>
                    </div>
                </form>
            </section>
        </div>

        <div class="col-lg-8">
            <section class="m-card">
                <header class="m-card__header">
                    <div>
                        <h2 class="m-card__title">Personal information</h2>
                    </div>
                </header>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
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

                <form action="<?= base_url('operator-maps/profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= old('nama', $user['nama']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= old('email', $user['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" value="<?= esc($user['role']) ?>" disabled>
                    </div>
                    <button type="submit" class="m-btn m-btn--primary">
                        <i class="fa-solid fa-floppy-disk"></i> Save changes
                    </button>
                </form>
            </section>
        </div>
    </div>
</div>