<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class OperatorMapsController extends BaseController
{

    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        return view('control-panel/maps/v_mapsDashboard');
    }

    public function inputDataSekolah()
    {
        return view('control-panel/maps/v_input');
    }

    public function profile()
    {
        $id   = session()->get('user_id');
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('/login')->with('error', 'Session tidak valid, silakan login ulang.');
        }

        return view('control-panel/maps/profile/v_profile', $data);
    }

    public function GeoJson()
    {
        return view('control-panel/maps/input/v_geoJson');
    }
    
}
