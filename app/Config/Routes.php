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


    $routes->group('admin', ['filter' => 'auth'], function ($routes) {

        // Bisa diakses Admin & Super Admin

        //sekolahh index
        $routes->get('sekolah', 'Controlpanel\Admin\SekolahController::index');

            //sekolah create
            $routes->get('sekolah/tambah', 'Controlpanel\Admin\SekolahController::create');
            $routes->post('sekolah/simpan', 'Controlpanel\Admin\SekolahController::store');

            //sekolah edit
            $routes->get('sekolah/edit/(:num)', 'Controlpanel\Admin\SekolahController::edit/$1');
            $routes->post('sekolah/update/(:num)', 'Controlpanel\Admin\SekolahController::update/$1');

            //sekolah detail
            $routes->get('sekolah/detail/(:num)', 'Controlpanel\Admin\SekolahController::show/$1');

            //sekolah destroy
            $routes->get('sekolah/hapus/(:num)', 'Controlpanel\Admin\SekolahController::destroy/$1');


        //geojson index
        $routes->get('geojson/list', 'Controlpanel\Admin\GeoJsonController::index');

            //geojson create
            $routes->get('geojson/create', 'Controlpanel\Admin\GeoJsonController::create');
            $routes->post('geojson/simpan', 'Controlpanel\Admin\GeoJsonController::store');

            //geojson edit
            $routes->get('geojson/edit/(:num)', 'Controlpanel\Admin\GeoJsonController::edit/$1');
            $routes->post('geojson/update/(:num)', 'Controlpanel\Admin\GeoJsonController::update/$1');

            //geojson detail
            $routes->get('geojson/detail/(:num)', 'Controlpanel\Admin\GeoJsonController::show/$1');

            //geojson destroy
            $routes->get('geojson/hapus/(:num)', 'Controlpanel\Admin\GeoJsonController::destroy/$1');

        
        //maps
        $routes->get('maps/index', 'controlpanel\admin\MapsController::index');


        //profile index
        $routes->get('profile', 'Controlpanel\Admin\ProfileController::index');

            //profile edit
            $routes->post('profile/update', 'Controlpanel\Admin\ProfileController::update');
            $routes->post('profile/foto', 'Controlpanel\Admin\ProfileController::foto');
            $routes->post('profile/password', 'Controlpanel\Admin\ProfileController::password'); 



        // only Super Admin
        // $routes->get('dashboard', 'Controlpanel\Admin\AdminController::dashboard', ['filter' => 'role:super_admin']);

        //laporan
        $routes->get('laporan', 'Controlpanel\Admin\LaporanController::index', ['filter' => 'role:super_admin']);
        $routes->get('laporan/export', 'Controlpanel\Admin\LaporanController::export', ['filter' => 'role:super_admin']);


        //user index
        $routes->get('user/list', 'Controlpanel\Admin\UserController::index', ['filter' => 'role:super_admin']);

            //user create
            $routes->get('user/create', 'Controlpanel\Admin\UserController::create', ['filter' => 'role:super_admin']);
            $routes->post('user/store', 'Controlpanel\Admin\UserController::store', ['filter' => 'role:super_admin']);

            //user deatil
            $routes->get('user/detail/(:num)', 'Controlpanel\admin\UserController::show/$1',['filter' => 'role:super_admin']);

            //detail destroy
            $routes->get('user/hapus/(:num)', 'Controlpanel\Admin\UserController::destroy/$1', ['filter' => 'role:super_admin']);


        //Laporan index
        $routes->get('laporan/dashboard', 'controlpanel\admin\LaporanController::index');
            $routes->get('laporan/export', 'controlpanel\admin\LaporanController::export');
    }); 





    
    // $routes->group('sekolah', function ($routes) {});


    // $routes->group('user', function ($routes) {

    //     //index
    //     $routes->get('list', 'Controlpanel\admin\UserController::index');

    //     //create
    //     $routes->get('create', 'Controlpanel\admin\UserController::create');
    //     $routes->post('store', 'Controlpanel\admin\UserController::store');

    //     //show
    //     $routes->get('detail/(:num)', 'Controlpanel\admin\UserController::show/$1');

    //     //destroy
    //     $routes->get('delete/(:num)', 'Controlpanel\admin\UserController::destroy/$1');
    // });


    // $routes->group('geojson', function ($routes) {

    //     //index
    //     $routes->get('list', 'controlpanel\admin\GeoJsonController::index');

    //     //create
    //     $routes->get('create', 'controlpanel\admin\GeoJsonController::create');
    //     $routes->post('simpan', 'controlpanel\admin\GeoJsonController::store');

    //     //edit
    //     $routes->get('edit/(:num)', 'controlpanel\admin\GeoJsonController::edit/$1');
    //     $routes->post('update/(:num)', 'controlpanel\admin\GeoJsonController::update/$1');

    //     //show
    //     $routes->get('detail/(:num)', 'controlpanel\admin\GeoJsonController::show/$1');

    //     //destoy
    //     $routes->get('hapus/(:num)', 'controlpanel\admin\GeoJsonController::destroy/$1');
    // });

    // $routes->group('maps', function ($routes) {

    //     //index
    //     $routes->get('index', 'controlpanel\admin\MapsController::index');
    // });

    // $routes->group('laporan', function ($routes) {

    //     //index
    //     $routes->get('dashboard', 'controlpanel\admin\LaporanController::index');
    //     $routes->get('export', 'controlpanel\admin\LaporanController::export');
    // });

    // $routes->group('profile', function ($routes) {

    //     //index
    //     $routes->get('dashboard', 'controlpanel\admin\ProfileController::index');

    //     //update
    //     $routes->post('update', 'controlpanel\admin\ProfileController::update');
    //     $routes->post('foto', 'controlpanel\admin\ProfileController::foto');
    //     $routes->post('password', 'controlpanel\admin\ProfileController::password');
    // });




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