<!DOCTYPE html>

<?php echo view('auth/component_auth'); ?>

<html lang="en">

<body class="app auth-page"><a class="visually-hidden-focusable skip-link" href="#auth-form">Skip to sign-in form</a>
    <main class="login-wrap" id="auth-form">
        <div class="login-content">
            <a href="<?= base_url('/') ?>" class="auth-brand" aria-label="CoolAdmin home">
                <span class="logo-mark" aria-hidden="true">C</span>
                <span class="logo-text">CoolAdmin</span>
            </a>
            <h1 class="auth-title">Welcome back</h1>
            <p class="auth-subtitle">Sign in to continue to your dashboard.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form class="login-form" action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="au-input" type="email" name="email"
                        placeholder="you@example.com" autocomplete="email" 
                        value="<?= old('email') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="au-input" type="password" name="password"
                        placeholder="••••••••" autocomplete="current-password" required>
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="<?= base_url('forget_password') ?>">Forgot password?</a>
                </div>
                <button class="au-btn au-btn--green" type="submit">Sign in</button>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="<?= base_url('register') ?>">Create one</a></p>
            </div>

        </div>
    </main>
</body>

</html>