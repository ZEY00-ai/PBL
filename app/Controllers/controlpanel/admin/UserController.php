<?php

namespace App\Controllers\Controlpanel\admin;

use App\Controllers\BaseController;
use App\Models\GeoJsonModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        return view('control-panel/admin/user/v_index', ['users' => $users]);
    }

    public function create()
    {
        return view('control-panel/admin/user/v_create');
    }

    public function store()
    {
        if (!$this->validate([
            'nama'             => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ], [
            'nama'             => ['required' => 'Nama wajib diisi.'],
            'email'            => ['required' => 'Email wajib diisi.', 'is_unique' => 'Email sudah terdaftar.'],
            'password'         => ['required' => 'Password wajib diisi.', 'min_length' => 'Password minimal 6 karakter.'],
            'confirm_password' => ['matches' => 'Konfirmasi password tidak cocok.'],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('user/akun')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('user/list')->with('error', 'Akun tidak ditemukan.');
        }

        return view('control-panel/admin/user/v_detail', $data);
    }

    public function destroy($id)
    {
        // Tidak boleh hapus akun sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->to('user/list')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('user/list')->with('error', 'Akun tidak ditemukan.');
        }

        // Hapus foto profil jika ada
        if (!empty($user['foto_profil'])) {
            $fotoPath = ROOTPATH . 'public/uploads/profil/' . $user['foto_profil'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $this->userModel->delete($id);
        return redirect()->to('user/list')->with('success', 'Akun berhasil dihapus.');
    }
}
