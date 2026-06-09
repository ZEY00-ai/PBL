<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="page-header">
                        <div>
                            <h1>Account &amp; settings</h1>
                            <p class="subtitle">Manage your profile, security.</p>
                        </div>
                        <div class="page-header__actions">
                            <button type="button" class="m-btn m-btn--ghost"
                                onclick="window.toast && window.toast.info('Discarded changes')">Cancel</button>
                            <button type="button" class="m-btn m-btn--primary"
                                onclick="window.toast && window.toast.success('Settings saved')">
                                <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Save changes
                            </button>
                        </div>
                    </div>

                    <ul class="nav nav-tabs settings-tabs" role="tablist"
                        style="border-bottom: 1px solid var(--m-divider); margin-bottom: 24px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-account"
                                type="button" role="tab">
                                <i class="fa-solid fa-user" aria-hidden="true"></i> Account
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-security"
                                type="button" role="tab">
                                <i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Security
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- account settings -->
                        <?php echo view('control-panel/maps/profile/v_account', ['user' => $user]); ?>
                        <!-- security settings -->
                        <?php echo view('control-panel/maps/profile/v_security', ['user' => $user]); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php echo view('control-panel/components/footer'); ?>
</body>

</html>