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
        helper(['url', 'form']);
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
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Role hanya bisa diisi kalau yang login super_admin
        // Menggunakan session 'user_role' dari AuthController
        $role = (session()->get('user_role') === 'super_admin')
            ? $this->request->getPost('role')
            : 'admin';

        $this->userModel->insert([
            'nama'         => $this->request->getPost('nama'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => $role,
            'foto_profil'  => 'default-avatar.jpg'
        ]);

        return redirect()->to('admin/user/list')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('admin/user/list')->with('error', 'Akun tidak ditemukan.');
        }

        return view('control-panel/admin/user/v_detail', $data);
    }

    // Edit user
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('admin/user/list')->with('error', 'Akun tidak ditemukan.');
        }

        return view('control-panel/admin/user/v_edit', $data);
    }

    // Update user
    public function update($id)
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];

        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Update role hanya untuk super_admin (menggunakan user_role dari session)
        if (session()->get('user_role') === 'super_admin') {
            $data['role'] = $this->request->getPost('role');
        }

        $this->userModel->update($id, $data);

        return redirect()->to('admin/user/list')->with('success', 'Akun berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Tidak boleh hapus akun sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->to('admin/user/list')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/user/list')->with('error', 'Akun tidak ditemukan.');
        }

        // Hapus foto profil jika ada dan bukan default
        // Menggunakan path yang sama dengan ProfileController: public/uploads/profil/
        if (!empty($user['foto_profil']) && $user['foto_profil'] != 'default-avatar.jpg') {
            $fotoPath = ROOTPATH . 'public/uploads/profil/' . $user['foto_profil'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $this->userModel->delete($id);
        return redirect()->to('admin/user/list')->with('success', 'Akun berhasil dihapus.');
    }

    // API untuk mengambil data user (AJAX)
    public function getUserData()
    {
        $user_id = $this->request->getGet('id') ?? session()->get('user_id');
        $user = $this->userModel->find($user_id);

        if ($user) {
            // Hapus password untuk keamanan
            unset($user['password']);
            return $this->response->setJSON($user);
        } else {
            return $this->response->setJSON([
                'error' => 'User not found'
            ])->setStatusCode(404);
        }
    }
}
