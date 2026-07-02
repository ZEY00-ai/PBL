<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{

    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('auth/v_login');
    }

    public function loginProcess()
    {
        $rules = [
            'login_id' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $loginId  = $this->request->getPost('login_id');
        $password = $this->request->getPost('password');

        // Cek apakah input berupa email atau nama
        if (filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
            $user = $this->userModel->where('email', $loginId)->first();
        } else {
            $user = $this->userModel->where('nama', $loginId)->first();
        }

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email/Nama atau password salah.');
        }

        session()->set([
            'logged_in'  => true,
            'user_id'    => $user['id'],
            'user_nama'  => $user['nama'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'user_foto'  => $user['foto_profil'],
            'sekolah_id' => $user['sekolah_id'] ?? null,
        ]);

        return redirect()->to('/dashboard')->with('success', 'Login berhasil.');
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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout');
    }
}
