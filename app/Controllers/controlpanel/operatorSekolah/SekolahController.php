<?php

namespace App\Controllers\Controlpanel\operatorSekolah;

use App\Controllers\BaseController;
use App\Models\GeoJsonModel;
use App\Models\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class SekolahController extends BaseController
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

        $data['geojson'] = (new GeoJsonModel())->findAll();

        return view('control-panel/admin/profileSekolah/v_index', $data);
    }

    public function edit()
    {
        $id = session()->get('sekolah_id');

        if (!$id) {
            return redirect()->to('/login')->with('error', 'Sesi sekolah tidak ditemukan, silakan login ulang.');
        }

        $data['sekolah'] = $this->sekolahModel->find($id);

        if (!$data['sekolah']) {
            return redirect()->to('admin/profileSekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        $data['geojson'] = (new GeoJsonModel())->findAll();

        return view('control-panel/admin/profileSekolah/v_edit', $data);
    }

    public function update()
    {
        $id = session()->get('sekolah_id');

        if (!$id) {
            return redirect()->to('/login')->with('error', 'Sesi sekolah tidak ditemukan, silakan login ulang.');
        }

        $sekolah = $this->sekolahModel->find($id);

        if (!$sekolah) {
            return redirect()->to('admin/profileSekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        if (!$this->validate([
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'geojson_id'    => 'required',
            'foto'          => 'permit_empty|max_size[foto,2048]|is_image[foto]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoName = $sekolah['foto'];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            if ($fotoName) {
                $fotoLama = ROOTPATH . 'public/uploads/sekolah/' . $fotoName;
                if (file_exists($fotoLama)) {
                    unlink($fotoLama);
                }
            }
            $fotoName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/sekolah', $fotoName);
        }

        $geojsonId = $this->request->getPost('geojson_id');
        $geo       = (new GeoJsonModel())->find($geojsonId);

        $this->sekolahModel->update($id, [
            // Field di bawah ini disabled di form (tidak boleh diubah operator sekolah),
            // jadi pakai nilai lama dari database, JANGAN diambil dari request.
            'nama_sekolah'  => $sekolah['nama_sekolah'],
            'tingkatan'     => $sekolah['tingkatan'],
            'npsn'          => $sekolah['npsn'],

            // Field di bawah ini bisa diedit operator sekolah.
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah') ?: null,
            'akreditasi'    => $this->request->getPost('akreditasi') ?: null,
            'nomor_sekolah' => $this->request->getPost('nomor_sekolah') ?: null,
            'email'         => $this->request->getPost('email') ?: null,
            'visi'          => $this->request->getPost('visi') ?: null,
            'misi'          => $this->request->getPost('misi') ?: null,
            'website'       => $this->request->getPost('website') ?: null,
            'alamat'        => $this->request->getPost('alamat'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'geojson_id'    => $geojsonId,
            'kecamatan'     => $geo['nama_kecamatan'] ?? null,
            'foto'          => $fotoName,
        ]);

        return redirect()->to('admin/profileSekolah')->with('success', 'Data sekolah berhasil diperbarui');
    }
}
