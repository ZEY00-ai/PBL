<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/v_login');
    }

    public function loginProcess()
    {
        $model =  new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->findByEmail($email);    

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email atau password salah');
        }

        return redirect()->to('/dashboard')->with('success', 'Login berhasil');

    }

    public function register()
    {
        return view('auth/v_register');
    }

    public function registerProcess()
    {
        $model = new UserModel();

        if(!$this->validate([
            'nama'      => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $model->insert([
            'nama'      => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
