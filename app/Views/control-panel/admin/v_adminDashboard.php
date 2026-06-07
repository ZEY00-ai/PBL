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
                            <h1>Dashboard admin</h1>
                            <p class="subtitle">Welcome back, Admin! <?= session()->get('user_nama') ?></p>
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
                    <div class="row row-tight">
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Visitors</p>
                                    <span class="stat-card__icon stat-card__icon--c1"><i class="fa-solid fa-users" aria-hidden="true"></i></span>
                                </div>
                                <p class="stat-card__value">84,290</p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>18.2% <span class="stat-card__delta-period">vs prev 28d</span>
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Sessions</p>
                                    <span class="stat-card__icon stat-card__icon--c2"><i class="fa-solid fa-eye" aria-hidden="true"></i></span>
                                </div>
                                <p class="stat-card__value">142,180</p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>22.4% <span class="stat-card__delta-period">vs prev 28d</span>
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Bounce rate</p>
                                    <span class="stat-card__icon stat-card__icon--c3"><i class="fa-solid fa-arrow-trend-down" aria-hidden="true"></i></span>
                                </div>
                                <p class="stat-card__value">38.4%</p>
                                <p class="stat-card__delta stat-card__delta--down">
                                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>2.1pp <span class="stat-card__delta-period">vs prev 28d</span>
                                </p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <article class="stat-card">
                                <div class="stat-card__head">
                                    <p class="stat-card__label">Avg session</p>
                                    <span class="stat-card__icon stat-card__icon--c4"><i class="fa-regular fa-clock" aria-hidden="true"></i></span>
                                </div>
                                <p class="stat-card__value">4m 12s</p>
                                <p class="stat-card__delta stat-card__delta--up">
                                    <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>14s <span class="stat-card__delta-period">vs prev 28d</span>
                                </p>
                            </article>
                        </div>
                        <div class="row row-tight" style="margin-top: 16px;">
                            <div class="col-lg-8">
                                <section class="m-card" aria-labelledby="projects-title">
                                    <header class="m-card__header">
                                        <div>
                                            <h2 class="m-card__title" id="projects-title">Active projects</h2>
                                            <p class="m-card__subtitle">Currently in progress, by completion.</p>
                                        </div>
                                        <a href="#" class="m-btn m-btn--ghost" style="height:30px; padding:0 10px; font-size:12.5px;">View all</a>
                                    </header>
                                    <ul class="project-list">
                                        <li>
                                            <div>
                                                <p class="project-list__title">Acme dashboard redesign</p>
                                                <span class="project-list__meta">Due May 18 · 12 tasks · <span class="status--process">on track</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-01.jpg" alt="">
                                                <img src="images/icon/avatar-04.jpg" alt="">
                                                <img src="images/icon/avatar-06.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar" style="--pct: 78%;"></span>
                                        </li>
                                        <li>
                                            <div>
                                                <p class="project-list__title">Q2 marketing campaign</p>
                                                <span class="project-list__meta">Due May 24 · 8 tasks · <span class="status--process">on track</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-02.jpg" alt="">
                                                <img src="images/icon/avatar-05.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar project-list__bar--success" style="--pct: 64%;"></span>
                                        </li>
                                        <li>
                                            <div>
                                                <p class="project-list__title">Mobile app v3 release</p>
                                                <span class="project-list__meta">Due Jun 02 · 24 tasks · <span class="status--approved">in review</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-01.jpg" alt="">
                                                <img src="images/icon/avatar-03.jpg" alt="">
                                                <img src="images/icon/avatar-05.jpg" alt="">
                                                <img src="images/icon/avatar-06.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar" style="--pct: 52%;"></span>
                                        </li>
                                        <li>
                                            <div>
                                                <p class="project-list__title">API v2 documentation</p>
                                                <span class="project-list__meta">Due May 20 · 6 tasks · <span class="status--process">on track</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-04.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar project-list__bar--success" style="--pct: 88%;"></span>
                                        </li>
                                        <li>
                                            <div>
                                                <p class="project-list__title">Customer onboarding flow</p>
                                                <span class="project-list__meta">Due May 28 · 14 tasks · <span class="status--denied">at risk</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-02.jpg" alt="">
                                                <img src="images/icon/avatar-04.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar project-list__bar--warning" style="--pct: 32%;"></span>
                                        </li>
                                        <li>
                                            <div>
                                                <p class="project-list__title">Pricing page A/B test</p>
                                                <span class="project-list__meta">Due Jun 10 · 4 tasks · <span class="status--approved">planning</span></span>
                                            </div>
                                            <div class="project-list__avatars">
                                                <img src="images/icon/avatar-05.jpg" alt="">
                                                <img src="images/icon/avatar-03.jpg" alt="">
                                            </div>
                                            <span class="project-list__bar" style="--pct: 18%;"></span>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-lg-4">
                                <section class="m-card" aria-labelledby="sources-donut-title">
                                    <header class="m-card__header">
                                        <div>
                                            <h2 class="m-card__title" id="sources-donut-title">Traffic sources</h2>
                                            <p class="m-card__subtitle">Share of incoming traffic.</p>
                                        </div>
                                    </header>
                                    <div class="donut-wrap">
                                        <canvas id="traffic-sources"></canvas>
                                    </div>
                                </section>
                            </div>
                        </div>
                </div>
            </div>
    </div>
    </div>
    </main>
    </div>
    </div>
    <?php echo view('control-panel/components/footer'); ?>
</body>

</html>