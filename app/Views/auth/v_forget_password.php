<!DOCTYPE html>

<?php echo view('auth/component_auth'); ?>

<html lang="en">
  <body class="app auth-page"><a class="visually-hidden-focusable skip-link" href="#auth-form">Skip to recovery form</a>
    <main class="login-wrap" id="auth-form">
      <div class="login-content">            <a href="index.html" class="auth-brand" aria-label="CoolAdmin home">
                <span class="logo-mark" aria-hidden="true">C</span>
                <span class="logo-text">CoolAdmin</span>
            </a>
            <h1 class="auth-title">Reset your password</h1>
            <p class="auth-subtitle">Enter your email and we'll send you a link to reset it.</p>

            <form class="login-form" action="" method="post" onsubmit="return false">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="au-input" type="email" name="email"
                        placeholder="you@example.com" autocomplete="email" required>
                </div>
                <button class="au-btn au-btn--green" type="submit">Send reset link</button>
            </form>

            <div class="register-link">
                <p>Remembered it? <a href="<?= base_url('login') ?>">Back to sign in</a></p>
            </div>

      </div>
</html>