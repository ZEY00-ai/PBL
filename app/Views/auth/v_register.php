<!DOCTYPE html>
<html lang="en">

<?php echo view('auth/component_auth'); ?>

  <body class="app auth-page"><a class="visually-hidden-focusable skip-link" href="#auth-form">Skip to sign-up form</a>
    <main class="login-wrap" id="auth-form">
      <div class="login-content">            <a href="<?= base_url('/') ?>" class="auth-brand" aria-label="CoolAdmin home">
                <span class="logo-mark" aria-hidden="true">C</span>
                <span class="logo-text">CoolAdmin</span>
            </a>
            <h1 class="auth-title">Create your account</h1>
            <p class="auth-subtitle">Start your 14-day free trial. No credit card required.</p>

            <form class="login-form" action="" method="post" onsubmit="return false">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" class="au-input" type="text" name="username"
                        placeholder="janedoe" autocomplete="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="au-input" type="email" name="email"
                        placeholder="you@example.com" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="au-input" type="password" name="password"
                        placeholder="At least 8 characters" autocomplete="new-password" minlength="8" required>
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" name="agree" required>
                        I agree to the <a href="#">terms</a> &amp; <a href="#">privacy policy</a>
                    </label>
                </div>
                <a href="<?= base_url('dashboard') ?>" class="au-btn au-btn--green">
                    Create account
                </a>
            </form>

            <div class="register-link">
                <p>Already have an account? <a href="<?= base_url('login') ?>">Sign in</a></p>
            </div>

      </div>
    </main>
  </body>
</html>