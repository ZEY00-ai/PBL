<!DOCTYPE html>
<html lang="en">

<?php echo view('auth/component_auth'); ?>

<body class="app auth-page"><a class="visually-hidden-focusable skip-link" href="#auth-form">Skip to sign-up form</a>
    <main class="login-wrap" id="auth-form">
        <div class="login-content">
            <a href="<?= base_url('/') ?>" class="auth-brand" aria-label="CoolAdmin home">
                <span class="logo-mark" aria-hidden="true">C</span>
                <span class="logo-text">CoolAdmin</span>
            </a>
            <h1 class="auth-title">Create your account</h1>
            <p class="auth-subtitle">Start your 14-day free trial. No credit card required.</p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul style="margin:0">
                        <?php foreach (session()->getFlashdata('errors') as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form class="login-form" action="<?= base_url('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" class="au-input" type="text" name="nama"
                        placeholder="janedoe" autocomplete="username"
                        value="<?= old('nama') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="au-input" type="email" name="email"
                        placeholder="you@example.com" autocomplete="email"
                        value="<?= old('email') ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" class="au-input" name="role" required>
                        <option value="">Select Role</option>
                        <option value="admin_sistem" <?= old('role') === 'admin_sistem' ? 'selected' : '' ?>>Admin Sistem</option>
                        <option value="operator_dinas" <?= old('role') === 'operator_dinas' ? 'selected' : '' ?>>Operator Dinas</option>
                        <option value="operator_maps" <?= old('role') === 'operator_maps' ? 'selected' : '' ?>>Operator Maps</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="au-input" type="password" name="password"
                        placeholder="At least 8 characters" autocomplete="new-password" minlength="6" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input id="confirm_password" class="au-input" type="password" name="confirm_password"
                        placeholder="Repeat password" required>
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" name="agree" required>
                        I agree to the <a href="#">terms</a> &amp; <a href="#">privacy policy</a>
                    </label>
                </div>
                <button class="au-btn au-btn--green" type="submit">Create account</button>
            </form>

            <div class="register-link">
                <p>Already have an account? <a href="<?= base_url('login') ?>">Sign in</a></p>
            </div>

        </div>
    </main>
</body>

</html>