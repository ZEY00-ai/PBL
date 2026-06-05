<!DOCTYPE html>
<html lang="en">

<?php echo view('control-panel/components/header'); ?>

<body class="app"><a class="visually-hidden-focusable skip-link" href="#main-content">Skip to main content</a>
    <div class="page-container">
        <main class="main-content" id="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <!-- Page header -->
                    <div class="page-header">
                        <div>
                            <h1>Dashboard</h1>
                            <p class="subtitle">Welcome back — here&rsquo;s what&rsquo;s happening across your business today.</p>
                        </div>
                        <div class="page-header__actions">
                            <button type="button" class="date-chip" aria-label="Date range: last 30 days">
                                <i class="fa-regular fa-calendar"></i>
                                Last 30 days
                                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="m-btn m-btn--ghost" id="dash-refresh-btn" aria-label="Refresh dashboard data">
                                <i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>
                                Refresh
                            </button>
                            <button type="button" class="m-btn m-btn--ghost">
                                <i class="fa-solid fa-download" aria-hidden="true"></i>
                                Export
                            </button>
                            <button type="button" class="m-btn m-btn--primary">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                New project
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
</body>

</html>