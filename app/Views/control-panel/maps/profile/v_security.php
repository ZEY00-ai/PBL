<form action="<?= base_url('operator-maps/profile/update-password') ?>" method="post">
    <?= csrf_field() ?>

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

    <div class="form-group">
        <label>Current password</label>
        <input type="password" name="current_password" class="form-control" autocomplete="current-password" required>
    </div>
    <div class="form-group">
        <label>New password</label>
        <input type="password" name="new_password" class="form-control" autocomplete="new-password" required>
    </div>
    <div class="form-group">
        <label>Confirm new password</label>
        <input type="password" name="confirm_password" class="form-control" autocomplete="new-password" required>
    </div>
    <button type="submit" class="m-btn m-btn--primary">Update password</button>
</form>