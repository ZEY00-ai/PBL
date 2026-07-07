<?php

namespace App\Controllers\Controlpanel\superAdmin;

use App\Controllers\BaseController;
use App\Models\GeoJsonModel;
use App\Models\SekolahModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class SekolahController extends BaseController
{

    protected SekolahModel $SekolahModel;
    protected UserModel $UserModel;

    public function __construct()
    {
        $this->SekolahModel = new SekolahModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data['sekolah'] = $this->SekolahModel->findAll();

        return view('control-panel/superAdmin/sekolah/v_index', $data);
    }

    public function create()
    {
        $data['geojson'] = (new GeoJsonModel())->findAll();
        return view('control-panel/superAdmin/sekolah/v_create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nama_sekolah'  => 'required',
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'geojson_id'    => 'required',
            'foto'          => 'max_size[foto,2048]|is_image[foto]',
            'npsn'          => 'permit_empty|is_unique[sekolah.npsn]',
        ],
        [
            'npsn' => [
                'is_unique' => 'NPSN sudah digunakan oleh sekolah lain.',
            ],
            ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoName = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/sekolah', $fotoName);
        }

        $geojsonId = $this->request->getPost('geojson_id');
        $geo       = (new GeoJsonModel())->find($geojsonId);

        $this->SekolahModel->insert([
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'tingkatan'     => $this->request->getPost('tingkatan'),
            'akreditasi'    => $this->request->getPost('akreditasi') ?: null,
            'npsn'          => $this->request->getPost('npsn') ?: null,
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

        // Ambil ID sekolah yang baru saja dibuat
        $newSekolahId = $this->SekolahModel->getInsertID();

        // Buat akun otomatis
        $npsn = $this->request->getPost('npsn');

        if ($npsn) {
            $emailAkun = $npsn . '@op.sekolah';
            $this->UserModel->insert([
                'nama'     => $this->request->getPost('nama_sekolah'),
                'email'    => $emailAkun,
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'status'   => 1,
                'sekolah_id' => $newSekolahId,
            ]);
            $akunBaru = [
                'email'    => $emailAkun,
                'password' => '12345678',
            ];
        }

        return redirect()->to('/superAdmin/sekolah')
        ->with('success', 'Data sekolah berhasil disimpan')
        ->with('akunBaru', $akunBaru);
    }

    public function edit($id)
    {
        $data['sekolah'] = $this->SekolahModel->find($id);
        $data['geojson'] = (new GeoJsonModel())->findAll();

        if (!$data['sekolah']) {
            return redirect()->to('superAdmin/sekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        return view('control-panel/superAdmin/sekolah/v_edit', $data);
    }

    public function update($id)
    {
        $sekolah = $this->SekolahModel->find($id);

        if (!$sekolah) {
            return redirect()->to('superAdmin/sekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        if (!$this->validate([
            'nama_sekolah'  => 'required',
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'geojson_id'    => 'required',
            'foto'          => 'max_size[foto,2048]|is_image[foto]',
            'npsn'          => "permit_empty|is_unique[sekolah.npsn,id,{$id}]",
        ],[
            'npsn' => [
                'is_unique' => 'NPSN sudah digunakan oleh sekolah lain.',
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
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

        $this->SekolahModel->update($id, [
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah') ?: null,
            'tingkatan'     => $this->request->getPost('tingkatan'),
            'akreditasi'    => $this->request->getPost('akreditasi') ?: null,
            'npsn'          => $this->request->getPost('npsn') ?: null,
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

        return redirect()->to('superAdmin/sekolah')->with('success', 'Data sekolah berhasil diperbarui');
    }

    public function show($id)
    {
        $data['sekolah'] = $this->SekolahModel->find($id);

        if (!$data['sekolah']) {
            return redirect()->to('superAdmin/sekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        return view('control-panel/superAdmin/sekolah/v_detail', $data);
    }

    public function destroy($id)
    {
        $sekolah = $this->SekolahModel->find($id);

        if ($sekolah && ! empty($sekolah['foto'])) {
            $fotoPath = ROOTPATH . 'public/uploads/sekolah/' . $sekolah['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $this->UserModel->where('sekolah_id', $id)->delete();
        $this->SekolahModel->delete($id);
        return redirect()->to('superAdmin/sekolah')->with('success', 'Data sekolah berhasil dihapus');
    }

    public function peta()
    {
        $data['sekolah'] = $this->SekolahModel->findAll();
        $data['geojson'] = (new GeoJsonModel())->findAll();
        return view('control-panel/maps/v_peta_sekolah', $data);
    }
}
