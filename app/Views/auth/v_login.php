<!DOCTYPE html>

<?php echo view('auth/component_auth'); ?>

<html lang="en">

<head>
    <style>
        .au-btn {
            display: flex;
            justify-content: center;
            /* teks horizontal center */
            align-items: center;
            /* teks vertikal center */
            text-align: center;
            /* pastikan teks rata tengah */
        }
    </style>
</head>

<body class="app auth-page">
    <main class="login-wrap" id="auth-form">
        <div class="login-content">
            <a href="<?= base_url('/') ?>" class="auth-brand" aria-label="CoolAdmin home">
                <span class="logo-mark" aria-hidden="true">C</span>
                <span class="logo-text">CoolAdmin</span>
            </a>

            
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
                </div>
                <button class="au-btn au-btn--green" type="submit">Sign in</button>
            </form>
            <div class="register-link">
                <p> <a href="<?= base_url('/') ?>">Kembali ke Landing Page</a></p>
            </div>
        </div>
    </main>
</body>
</html>