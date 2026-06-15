<?php

namespace App\Controllers\Controlpanel\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MapsController extends BaseController
{

    public function index()
    {
        $data['sekolah'] = (new \App\Models\SekolahModel())->findAll();
        $data['geojson'] = (new \App\Models\GeoJsonModel())->findAll();
        return view('control-panel/admin/maps/v_peta_sekolah', $data);
    }
}
