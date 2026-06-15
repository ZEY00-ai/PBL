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

    public function index()
    {
        $data['user'] = $this->userModel->find(session()->get('user_id'));

        if (!$data['user']) {
            return redirect()->to('/login')->with('error', 'Session tidak valid.');
        }

        return view('control-panel/admin/profile/v_index', $data);
    }

    public function updateProfile()
    {
        $id = session()->get('user_id');

        if (!$this->validate([
            'nama'  => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'nama'  => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ]);

        session()->set('user_nama', $this->request->getPost('nama'));
        session()->set('user_email', $this->request->getPost('email'));

        return redirect()->back()->with('success', 'Profile berhasil diupdate.');
    }

    public function updateFoto()
    {
        $id   = session()->get('user_id');
        $user = $this->userModel->find($id);

        if (!$this->validate([
            'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|is_image[foto_profil]',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto_profil');

        if (!empty($user['foto_profil'])) {
            $fotoLama = ROOTPATH . 'public/uploads/profil/' . $user['foto_profil'];
            if (file_exists($fotoLama)) unlink($fotoLama);
        }

        $fotoName = $foto->getRandomName();
        $foto->move(ROOTPATH . 'public/uploads/profil', $fotoName);

        $this->userModel->update($id, ['foto_profil' => $fotoName]);

        return redirect()->back()->with('success_foto', 'Foto profil berhasil diupdate.');
    }

    public function updatePassword()
    {
        $id   = session()->get('user_id');
        $user = $this->userModel->find($id);

        if (!$this->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ])) {
            return redirect()->back()->with('errors_password', $this->validator->getErrors());
        }

        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error_password', 'Password lama tidak sesuai.');
        }

        $this->userModel->update($id, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success_password', 'Password berhasil diubah.');
    }
}
