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
    $routes->get('/dashboard', 'Controlpanel\admin\DashboardController::index');


    $routes->group('admin', function ($routes) {
        // $routes->get('dashboard', 'Controlpanel\AdminController::dashboard');

        //index
        $routes->get('sekolah', 'controlpanel\admin\SekolahController::index');
        //create 
        $routes->get('sekolah/tambah', 'Controlpanel\admin\SekolahController::create');
        $routes->post('sekolah/simpan', 'Controlpanel\admin\SekolahController::store');
        //edit
        $routes->get('sekolah/edit/(:num)', 'controlpanel\admin\SekolahController::edit/$1');
        $routes->post('sekolah/update/(:num)', 'controlpanel\admin\SekolahController::update/$1');

        //show
        $routes->get('sekolah/detail/(:num)', 'controlpanel\admin\SekolahController::show/$1');
        //destroy
        $routes->get('sekolah/hapus/(:num)', 'controlpanel\admin\SekolahController::destroy/$1');
    });

    $routes->group('sekolah', function ($routes) {});


    $routes->group('user', function ($routes) {

        //index
        $routes->get('list', 'Controlpanel\admin\UserController::index');

        //create
        $routes->get('create', 'Controlpanel\admin\UserController::create');
        $routes->post('store', 'Controlpanel\admin\UserController::store');

        //show
        $routes->get('detail/(:num)', 'Controlpanel\admin\UserController::show/$1');

        //destroy
        $routes->get('delete/(:num)', 'Controlpanel\admin\UserController::destroy/$1');
    });


    $routes->group('geojson', function ($routes) {

        //index
        $routes->get('list', 'controlpanel\admin\GeoJsonController::index');

        //create
        $routes->get('create', 'controlpanel\admin\GeoJsonController::create');
        $routes->post('simpan', 'controlpanel\admin\GeoJsonController::store');

        //edit
        $routes->get('edit/(:num)', 'controlpanel\admin\GeoJsonController::edit/$1');
        $routes->post('update/(:num)', 'controlpanel\admin\GeoJsonController::update/$1');

        //show
        $routes->get('detail/(:num)', 'controlpanel\admin\GeoJsonController::show/$1');

        //destoy
        $routes->get('hapus/(:num)', 'controlpanel\admin\GeoJsonController::destroy/$1');
    });

    $routes->group('maps', function ($routes) {

        //index
        $routes->get('index', 'controlpanel\admin\MapsController::index');
    });

    $routes->group('laporan', function ($routes) {

        //index
        $routes->get('dashboard', 'controlpanel\admin\LaporanController::index');
        $routes->get('export', 'controlpanel\admin\LaporanController::export');
    });

    $routes->group('profile', function ($routes) {

        //index
        $routes->get('dashboard', 'controlpanel\admin\ProfileController::index');

        //update
        $routes->post('update', 'controlpanel\admin\ProfileController::update');
        $routes->post('foto', 'controlpanel\admin\ProfileController::foto');
        $routes->post('password', 'controlpanel\admin\ProfileController::password');
    });




    // // Operator Dinas
    // $routes->group('operator-dinas', ['filter' => 'role:operator_dinas'], function ($routes) {
    //     $routes->get('dashboard', 'ControlPanel\OperatorDinasController::dashboard');
    // });

    // // Operator Maps
    // $routes->group('operator-maps', ['filter' => 'role:operator_maps'], function ($routes) {
    //     $routes->get('dashboard', 'Controlpanel\OperatorMapsController::dashboard');
    //     $routes->get('input-data-sekolah', 'Controlpanel\OperatorMapsController::inputDataSekolah');
    //     $routes->get('sekolah', 'Controlpanel\SekolahController::index');
    //     $routes->get('sekolah/tambah', 'Controlpanel\SekolahController::tambah');
    //     $routes->post('sekolah/simpan', 'Controlpanel\SekolahController::simpan');
    //     $routes->get('sekolah/peta', 'Controlpanel\SekolahController::peta');
    //     $routes->get('sekolah/hapus/(:num)', 'Controlpanel\SekolahController::hapus/$1');
    //     $routes->get('sekolah/edit/(:num)', 'Controlpanel\SekolahController::edit/$1');
    //     $routes->post('sekolah/update/(:num)', 'Controlpanel\SekolahController::update/$1');

    //     // profile
    //     $routes->get('profile', 'Controlpanel\ProfileController::index');
    //     $routes->post('profile/update', 'Controlpanel\ProfileController::updateProfile');
    //     $routes->post('profile/update-foto', 'Controlpanel\ProfileController::updatefoto');
    //     $routes->post('profile/update-password', 'Controlpanel\ProfileController::updatePassword');

    //     // GeoJson
    //     $routes->get('input-geojson', 'Controlpanel\GeoJsonController::index');
    //     $routes->post('input-geojson/simpan', 'Controlpanel\GeoJsonController::simpan');
    //     $routes->get('maps', 'Controlpanel\GeoJsonController::peta');
    //     $routes->get('geojson/hapus/(:num)', 'Controlpanel\GeoJsonController::hapus/$1');
    //     $routes->get('geojson/list', 'Controlpanel\GeoJsonController::list');
    //     $routes->get('geojson/edit/(:num)', 'Controlpanel\GeoJsonController::edit/$1');
    //     $routes->post('geojson/update/(:num)', 'Controlpanel\GeoJsonController::update/$1');
    //});