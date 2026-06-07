<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OperatorMapsController extends BaseController
{
    public function dashboard()
    {
        return view('control-panel/maps/v_mapsDashboard');
    }

    public function inputDataSekolah()
    {
        return view('control-panel/maps/v_input');
    }
    
}
