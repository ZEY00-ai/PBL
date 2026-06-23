<?php

namespace App\Controllers\Controlpanel\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * GET /profile/dashboard
     * Menampilkan halaman Account & Settings.
     */
    public function index()
    {
        $userId = session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);

        if (! $user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan, silakan login ulang.');
        }

        // Sync session dengan data database
        session()->set('user_foto', $user['foto_profil']);

        return view('control-panel/admin/profile/v_index', [
            'user' => $user,
        ]);
    }

    /**
     * POST /profile/update
     * Update nama & email.
     */
    public function update()
    {
        $userId = session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $rules = [
            'nama'  => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|max_length[150]|is_unique[users.email,id,{$userId}]",
        ];

        if (! $this->validate($rules, [
            'nama'  => ['required' => 'Nama wajib diisi.'],
            'email' => ['required' => 'Email wajib diisi.', 'is_unique' => 'Email sudah dipakai akun lain.'],
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($userId, [
            'nama'  => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to(base_url('admin/profile'))
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * POST /profile/foto
     * Upload / ganti foto profil. Dipanggil otomatis lewat JS saat file dipilih.
     */
    public function foto()
    {
        $userId = session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $rules = [
            'foto_profil' => 'uploaded[foto_profil]'
                . '|max_size[foto_profil,2048]'
                . '|is_image[foto_profil]'
                . '|mime_in[foto_profil,image/jpg,image/jpeg,image/png,image/gif]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('profile/dashboard'))
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('foto_profil');

        if (! $file->isValid() || $file->hasMoved()) {
            return redirect()->to(base_url('profile/dashboard'))
                ->with('errors', ['Upload foto gagal, silakan coba lagi.']);
        }

        // Sama seperti path yang dipakai destroy() di UserController kamu.
        $uploadPath = ROOTPATH . 'public/uploads/profil/';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        $user = $this->userModel->find($userId);

        // Hapus foto lama biar tidak menumpuk file sampah.
        if (! empty($user['foto_profil']) && is_file($uploadPath . $user['foto_profil'])) {
            unlink($uploadPath . $user['foto_profil']);
        }

        $this->userModel->update($userId, ['foto_profil' => $newName]);

        return redirect()->to(base_url('admin/profile'))
            ->with('success_foto', 'Foto profil berhasil diperbarui.');
    }

    /**
     * POST /profile/password
     * Ganti password.
     */
    public function password()
    {
        $userId = session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $rules = [
            'current_password' => 'required',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->with('errors_password', $this->validator->getErrors());
        }

        $user = $this->userModel->find($userId);

        if (! $user || ! password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()
                ->with('error_password', 'Password lama yang kamu masukkan salah.');
        }

        $this->userModel->update($userId, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to(base_url('admin/profile'))
            ->with('success_password', 'Password berhasil diperbarui.');
    }
}
