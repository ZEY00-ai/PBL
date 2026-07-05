    <?php

    use CodeIgniter\Router\RouteCollection;

    /** @var RouteCollection $routes */
    $routes->get('/', 'Home::index');
    $routes->get('peta', 'Home::petaFull');


    //login
    $routes->get('/login', 'Auth\AuthController::login');
    $routes->post('/login', 'Auth\AuthController::loginProcess');

    //logout
    $routes->get('/logout', 'Auth\AuthController::logout');

    //dashboard
    $routes->get('/dashboard', 'Controlpanel\DashboardController::index');

    //maps
    $routes->get('maps/index', 'Controlpanel\MapsController::index');

    // Profile / Account & Settings
    $routes->get('profile', 'Controlpanel\ProfileController::index');
    $routes->post('profile/update', 'Controlpanel\ProfileController::update');
    $routes->post('profile/foto', 'Controlpanel\ProfileController::foto');
    $routes->post('profile/password', 'Controlpanel\ProfileController::password');

    //dashboard
    $routes->get('/dashboard', 'Controlpanel\DashboardController::index');

    $routes->get('sekolah/(:num)', 'Home::sekolahDetail/$1');

    // =================
    // SUPER ADMIN     =
    // =================

    $routes->group('superAdmin', ['filter' => 'role:super_admin'], function ($routes) {

        // =================
        // Sekolah         =
        // =================

        //sekolahh index
        $routes->get('sekolah', 'Controlpanel\superAdmin\SekolahController::index');

        //sekolah create
        $routes->get('sekolah/tambah', 'Controlpanel\superAdmin\SekolahController::create');
        $routes->post('sekolah/simpan', 'Controlpanel\superAdmin\SekolahController::store');

        //sekolah edit
        $routes->get('sekolah/edit/(:num)', 'Controlpanel\superAdmin\SekolahController::edit/$1');
        $routes->post('sekolah/update/(:num)', 'Controlpanel\superAdmin\SekolahController::update/$1');

        //sekolah detail
        $routes->get('sekolah/detail/(:num)', 'Controlpanel\superAdmin\SekolahController::show/$1');

        //sekolah destroy
        $routes->get('sekolah/hapus/(:num)', 'Controlpanel\superAdmin\SekolahController::destroy/$1');


        // =================
        // GeoJson         =
        // =================

        //geojson index
        $routes->get('geojson/list', 'Controlpanel\superAdmin\GeoJsonController::index');

        //geojson create
        $routes->get('geojson/create', 'Controlpanel\superAdmin\GeoJsonController::create');
        $routes->post('geojson/simpan', 'Controlpanel\superAdmin\GeoJsonController::store');

        //geojson edit
        $routes->get('geojson/edit/(:num)', 'Controlpanel\superAdmin\GeoJsonController::edit/$1');
        $routes->post('geojson/update/(:num)', 'Controlpanel\superAdmin\GeoJsonController::update/$1');

        //geojson detail
        $routes->get('geojson/detail/(:num)', 'Controlpanel\superAdmin\GeoJsonController::show/$1');

        //geojson destroy
        $routes->get('geojson/hapus/(:num)', 'Controlpanel\superAdmin\GeoJsonController::destroy/$1');


        // =================
        // Kelola akun     =
        // =================

        //user index
        $routes->get('user/list', 'Controlpanel\superAdmin\UserController::index');

        //user create
        $routes->get('user/create', 'Controlpanel\superAdmin\UserController::create');
        $routes->post('user/store', 'Controlpanel\superAdmin\UserController::store');

        //user edit
        $routes->get('user/edit/(:num)', 'Controlpanel\superAdmin\UserController::edit/$1');
        $routes->post('user/update/(:num)', 'Controlpanel\superAdmin\UserController::update/$1');

        //user deatil
        $routes->get('user/detail/(:num)', 'Controlpanel\superAdmin\UserController::show/$1');

        //detail destroy
        $routes->get('user/hapus/(:num)', 'Controlpanel\superAdmin\UserController::destroy/$1');
    });


    // =================
    // ADMIN           =
    // =================

    $routes->group('admin', ['filter' => 'auth'], function ($routes) {

        // =================
        // Profile sekolah =
        // =================

        //profile sekolah index
        $routes->get('profileSekolah', 'Controlpanel\operatorSekolah\SekolahController::index');
        //profile edit
        $routes->get('profileSekolah/edit/(:num)', 'Controlpanel\operatorSekolah\SekolahController::edit/$1');
        $routes->post('profileSekolah/update', 'Controlpanel\operatorSekolah\SekolahController::update');

        // =================
        // LOKASI SEKOLAH  =
        // =================

        $routes->get('lokasiSekolah', 'Controlpanel\operatorSekolah\LokasiController::index');
        $routes->post('lokasiSekolah/update/(:num)', 'Controlpanel\operatorSekolah\LokasiController::updateLokasi/$1');



        //laporan
        $routes->get('laporan', 'Controlpanel\Admin\LaporanController::index');
        $routes->get('laporan/export', 'Controlpanel\Admin\LaporanController::export');




        //Laporan index
        $routes->get('laporan/dashboard', 'controlpanel\admin\LaporanController::index');
        $routes->get('laporan/export', 'controlpanel\admin\LaporanController::export');
    });
