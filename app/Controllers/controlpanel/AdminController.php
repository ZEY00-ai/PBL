<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function dashboard()
    {
        return view('control-panel/admin/v_adminDashboard');
    }

    public function kelolaUser()
    {
        return view('control-panel/admin/v_kelolaUser');
    }
}
