  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="generator" content="CoolAdmin 3.3.0" />
      <meta name="description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
      <title> | CoolAdmin Bootstrap 5 Admin Dashboard</title>
      <meta property="og:type" content="website" />
      <meta property="og:title" content="Dashboard | CoolAdmin Bootstrap 5 Admin Dashboard" />
      <meta property="og:description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
      <meta property="og:image" content="screenshots/cooladmin-bootstrap-dashboard-2.png" />
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="Dashboard | CoolAdmin Bootstrap 5 Admin Dashboard" />
      <meta name="twitter:description" content="Modern Bootstrap 5 admin dashboard with Chart.js widgets, responsive tables, and clean typography." />
      <meta name="theme-color" content="#4272d7" />
      <link href="<?= base_url('CoolAdmin-master/css/font-face.css') ?>" rel="stylesheet" media="all" />
      <link href="<?= base_url('CoolAdmin-master/css/font-face.css') ?>" rel="stylesheet" media="all" />
      <link rel="preconnect" href="https://rsms.me/" />
      <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
      <link href="<?= base_url('CoolAdmin-master/vendor/fontawesome-7.2.0/css/all.min.css') ?>" rel="stylesheet" media="all" />
      <link href="<?= base_url('CoolAdmin-master/vendor/bootstrap-5.3.8.min.css') ?>" rel="stylesheet" media="all" />
      <link href="<?= base_url('CoolAdmin-master/vendor/css-hamburgers/hamburgers.min.css') ?>" rel="stylesheet" media="all" />
      <link href="<?= base_url('CoolAdmin-master/css/theme.css') ?>" rel="stylesheet" media="all" />
      <link href="<?= base_url('CoolAdmin-master/css/app.css') ?>" rel="stylesheet" media="all" />
      <!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="" />
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>
  </head>
  <header class="header-desktop">
      <div class="section__content section__content--p30">
          <div class="container-fluid">
              <div class="header-wrap">
                  <div class="noti-wrap">
                      <!-- Jam & Tanggal -->
                      <div style="display:flex; flex-direction:column; align-items:flex-end; margin-right:16px; line-height:1.4;">
                          <span id="live-time" style="font-size:15px; font-weight:700; color:var(--m-text);"></span>
                          <span id="live-date" style="font-size:11px; color:var(--m-text-muted);"></span>
                      </div>
                  </div>
                  <div class="header-button">
                      <div class="account-wrap">
                          <div class="account-item clearfix js-item-menu" role="button" tabindex="0" aria-haspopup="true" aria-label="Account menu">
                              <div class="image"><img src="images/icon/avatar-01.jpg" alt="John Doe"></div>
                              <div class="content"><a class="js-acc-btn" href="#">john doe</a></div>
                              <div class="account-dropdown js-dropdown">
                                  <div class="info clearfix">
                                      <div class="image"><a href="#"><img src="images/icon/avatar-01.jpg" alt="John Doe"></a></div>
                                      <div class="content">
                                          <h5 class="name"><a href="#">john doe</a></h5><span class="email">johndoe@example.com</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <script>
          function updateClock() {
              const now = new Date();

              // Jam
              const jam = now.toLocaleTimeString('id-ID', {
                  hour: '2-digit',
                  minute: '2-digit',
                  second: '2-digit'
              });

              // Tanggal
              const hari = now.toLocaleDateString('id-ID', {
                  weekday: 'long',
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric'
              });

              document.getElementById('live-time').textContent = jam;
              document.getElementById('live-date').textContent = hari;
          }

          updateClock();
          setInterval(updateClock, 1000);
      </script>
  </header>

  <?php echo view('control-panel/components/sidebar'); ?>



  <style>
      /* Hide right chevron/arrow in sidebar menu items */
      .menu-sidebar .navbar__list li.has-sub>a::after,
      .menu-sidebar .navbar__list li>a.js-arrow::after,
      .navbar-mobile__list .js-arrow::after {
          display: none !important;
      }
  </style>