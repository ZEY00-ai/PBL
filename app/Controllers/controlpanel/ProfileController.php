<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{

    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

public function index()
{ 

    $id   = session()->get('user_id');
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Session tidak valid, silakan login ulang.');
    }

    $data['user'] = $user;
    return view('control-panel/maps/v_profile', $data);
}

    public function updateProfile()
    {
        $id = session()->get('user_id');

        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ]);

        session()->set('nama', $this->request->getPost('nama'));
        session()->set('email', $this->request->getPost('email'));

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatefoto()
    {
        $id = session()->get('user_id');
        $user = $this->userModel->find($id);

        if (!$this->validate([
            'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|is_image[foto_profil]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto_profil');

        if ($user['foto_profil']) {
            $fotoLamaPath = WRITEPATH . 'uploads/' . $user['foto_profil'];
            if (file_exists($fotoLamaPath)) {
                unlink($fotoLamaPath);
            }
        }

        $fotoName = $foto->getRandomName();
        $foto->move(WRITEPATH . 'uploads/', $fotoName);

        $this->userModel->update($id, [
            'foto_profil' => $fotoName,
        ]);

        return redirect()->back()->with('success', 'Foto profil updated successfully.');
    }

    public function updatePassword()
    {
        $id = session()->get('user_id');
        $user = $this->userModel->find($id);

        if (!$this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Current password is incorrect.');
        }

        $this->userModel->update($id, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
