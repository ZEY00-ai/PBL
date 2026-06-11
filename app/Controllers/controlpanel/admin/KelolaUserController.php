<?php

namespace App\Controllers\Controlpanel\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelolaUserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('control-panel/admin/v_kelolaUser');
    }

    public function list()
    {
        $users = $this->userModel->findAll();
        return view('control-panel/admin/v_kelolaUser', ['users' => $users]);
    }

}
