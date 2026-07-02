<?php

namespace App\Controllers\Controlpanel\operatorSekolah;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class LokasiController extends BaseController
{
    protected SekolahModel $sekolahModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
    }

    public function index()
    {
        $sekolahId = session()->get('sekolah_id');

        if (!$sekolahId) {
            return redirect()->to('/login')->with('error', 'Sesi sekolah tidak ditemukan, silakan login ulang.');
        }

        $data['sekolah'] = $this->sekolahModel->find($sekolahId);

        if (!$data['sekolah']) {
            return redirect()->to('/login')->with('error', 'Data sekolah tidak ditemukan.');
        }

        return view('control-panel/admin/lokasiSekolah/v_index', $data);
    }

    public function updateLokasi($id)
    {
        $sekolahId = session()->get('sekolah_id');

        // Pastikan operator cuma bisa update sekolahnya sendiri
        if ((int) $sekolahId !== (int) $id) {
            return redirect()->to('/login')->with('error', 'Akses tidak sah.');
        }

        $rules = [
            'latitude'  => 'required|decimal',
            'longitude' => 'required|decimal',
            'radius'    => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->sekolahModel->update($id, [
            'latitude'  => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'alamat'    => $this->request->getPost('alamat'),
            'radius'    => $this->request->getPost('radius') ?: 100,
        ]);

        return redirect()->to('admin/profileSekolah/lokasi')->with('success', 'Lokasi sekolah berhasil diperbarui.');
    }
}
