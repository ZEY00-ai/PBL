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
                  <button class="sidebar-toggle js-sidebar-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="main-sidebar"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
                  <form class="form-header" role="search" onsubmit="return false"><i class="fa-solid fa-magnifying-glass form-header__icon" aria-hidden="true"></i>
                      <input class="au-input au-input--xl" type="search" name="search" placeholder="Search anything…" aria-label="Search"><kbd class="form-header__hint" aria-hidden="true">⌘K</kbd>
                  </form>
                  <div class="header-button">
                      <div class="noti-wrap">
                          <div class="noti__item js-item-menu" role="button" tabindex="0" aria-haspopup="true" aria-label="Messages"><i class="fa-solid fa-comment-dots"></i><span class="quantity">1</span>
                              <div class="mess-dropdown js-dropdown">
                                  <div class="mess__title">
                                      <p>You have 2 news message</p>
                                  </div>
                                  <div class="mess__item">
                                      <div class="image img-cir img-40"><img src="images/icon/avatar-06.jpg" alt="Michelle Moreno"></div>
                                      <div class="content">
                                          <h6>Michelle Moreno</h6>
                                          <p>Have sent a photo</p><span class="time">3 min ago</span>
                                      </div>
                                  </div>
                                  <div class="mess__item">
                                      <div class="image img-cir img-40"><img src="images/icon/avatar-04.jpg" alt="Diane Myers"></div>
                                      <div class="content">
                                          <h6>Diane Myers</h6>
                                          <p>You are now connected on message</p><span class="time">Yesterday</span>
                                      </div>
                                  </div>
                                  <div class="mess__footer"><a href="#">View all messages</a></div>
                              </div>
                          </div>
                          <div class="noti__item js-item-menu" role="button" tabindex="0" aria-haspopup="true" aria-label="Emails"><i class="fa-solid fa-envelope"></i><span class="quantity">1</span>
                              <div class="email-dropdown js-dropdown">
                                  <div class="email__title">
                                      <p>You have 3 New Emails</p>
                                  </div>
                                  <div class="email__item">
                                      <div class="image img-cir img-40"><img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey"></div>
                                      <div class="content">
                                          <p>Meeting about new dashboard...</p><span>Cynthia Harvey, 3 min ago</span>
                                      </div>
                                  </div>
                                  <div class="email__item">
                                      <div class="image img-cir img-40"><img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey"></div>
                                      <div class="content">
                                          <p>Meeting about new dashboard...</p><span>Cynthia Harvey, Yesterday</span>
                                      </div>
                                  </div>
                                  <div class="email__item">
                                      <div class="image img-cir img-40"><img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey"></div>
                                      <div class="content">
                                          <p>Meeting about new dashboard...</p><span>Cynthia Harvey, January 15, 2025</span>
                                      </div>
                                  </div>
                                  <div class="email__footer"><a href="#">See all emails</a></div>
                              </div>
                          </div>
                          <div class="noti__item js-item-menu" role="button" tabindex="0" aria-haspopup="true" aria-label="Notifications"><i class="fa-solid fa-bell"></i><span class="quantity">3</span>
                              <div class="notifi-dropdown js-dropdown">
                                  <div class="notifi__title">
                                      <p>You have 3 Notifications</p>
                                  </div>
                                  <div class="notifi__item">
                                      <div class="bg-c1 img-cir img-40"><i class="fa-solid fa-envelope-open"></i></div>
                                      <div class="content">
                                          <p>You got a email notification</p><span class="date">January 15, 2025 14:30</span>
                                      </div>
                                  </div>
                                  <div class="notifi__item">
                                      <div class="bg-c2 img-cir img-40"><i class="fa-solid fa-id-card"></i></div>
                                      <div class="content">
                                          <p>Your account has been blocked</p><span class="date">January 15, 2025 14:30</span>
                                      </div>
                                  </div>
                                  <div class="notifi__item">
                                      <div class="bg-c3 img-cir img-40"><i class="fa-solid fa-file-lines"></i></div>
                                      <div class="content">
                                          <p>You got a new file</p><span class="date">January 15, 2025 14:30</span>
                                      </div>
                                  </div>
                                  <div class="notifi__footer"><a href="#">All notifications</a></div>
                              </div>
                          </div>
                      </div>
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
                                  <div class="account-dropdown__body">
                                      <div class="account-dropdown__item"><a href="#"><i class="fa-solid fa-user"></i>Account</a></div>
                                      <div class="account-dropdown__item"><a href="#"><i class="fa-solid fa-gear"></i>Setting</a></div>
                                      <div class="account-dropdown__item"><a href="#"><i class="fa-solid fa-sack-dollar"></i>Billing</a></div>
                                  </div>
                                  <div class="account-dropdown__footer"><a href="<?= base_url('logout') ?>"><i class="fa-solid fa-power-off"></i>Logout</a></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
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