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
        $model = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email atau password salah');
        }

        // Simpan session
        session()->set([
            'logged_in'  => true,
            'user_id'    => $user['id'],
            'user_nama'  => $user['nama'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'role'       => $user['role'],
        ]);

        // Redirect berdasarkan role
        $role = $user['role'];

        if ($role === 'admin_sistem') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role === 'operator_dinas') {
            return redirect()->to('/operator-dinas/dashboard');
        } else {
            return redirect()->to('/operator-maps/dashboard');
        }
    }

    public function register()
    {
        return view('auth/v_register');
    }

    public function registerProcess()
    {
        $model = new UserModel();

        if (!$this->validate([
            'nama'      => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $model->insert([
            'nama'      => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout');
    }
}
