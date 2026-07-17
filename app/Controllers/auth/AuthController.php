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
        //membaca validasi input
        $rules = [
            'login_id' => 'required',
            'password' => 'required',
        ];
        //kalau validasinya gagal dia akan kembali ke halaman login
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

        //jika user atau password tidak sesuai maka akan kembali ke halaman login
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email/Nama atau password salah.');
        }

        //jika user dan password sesuai maka akan membuat session
        session()->set([
            'logged_in'   => true,
            'user_id'     => $user['id'],
            'user_nama'   => $user['nama'],
            'user_email'  => $user['email'],
            'user_role'   => $user['role'],
            'user_foto'   => $user['foto_profil'],
            'foto_profil' => $user['foto_profil'],
            'sekolah_id'  => $user['sekolah_id'] ?? null,//ini null karena super admin tidak punya sekolah_id, jadi kita kasih null
        ]);

        // Redirect berdasarkan role
        switch ($user['role']) {
            case 'super_admin':
                return redirect()->to('/dashboard')->with('success', 'Login berhasil.');
                
            case 'admin':
                return redirect()->to('/admin/profileSekolah')->with('success', 'Login berhasil.');

            default:
                return redirect()->back()->with('error', 'Login tidak sah.');
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
