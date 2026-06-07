<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OperatorDinasController extends BaseController
{
    public function dashboard()
    {
        return view('control-panel/dinas/v_dinasDashboard');
    }
}

