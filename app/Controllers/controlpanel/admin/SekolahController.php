<?php

namespace App\Controllers\Controlpanel\Admin;

use App\Controllers\BaseController;
use App\Models\GeoJsonModel;
use App\Models\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class SekolahController extends BaseController
{

    protected SekolahModel $SekolahModel;

    public function __construct()
    {
        $this->SekolahModel = new SekolahModel();
    }

    public function index()
    {
        $data['sekolah'] = $this->SekolahModel->findAll();
        return view('control-panel/admin/sekolah/v_index', $data);
    }

    public function create()
    {
        return view('control-panel/admin/sekolah/v_create');
    }

    public function store()
    {

        if (!$this->validate([
            'nama_sekolah'  => 'required',
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'kecamatan'     => 'required',
            'foto'          => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
        ]))

            $fotoName = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/sekolah', $fotoName);
        }
        $this->SekolahModel->insert([
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'npsn'          => $this->request->getPost('npsn') ?: null,
            'tahun_berdiri' => $this->request->getPost('tahun_berdiri') ?: null,
            'website'       => $this->request->getPost('website') ?: null,
            'alamat'        => $this->request->getPost('alamat'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'foto'          => $fotoName,
        ]);


        return redirect()->to('/admin/sekolah')->with('success', 'Data sekolah berhasil disimpan');
    }

    public function edit($id)
    {

        $data['sekolah'] = $this->SekolahModel->find($id);
        $data['geojson'] = $this->SekolahModel->find($id);


        if (!$data['sekolah']) {
            return redirect()->to('admin/v_index')->with('error', 'Data sekolah tidak ditemukan');
        }

        return view('control-panel/admin/sekolah/v_edit', $data);
    }

    public function update($id)
    {

        $sekolah = $this->SekolahModel->find($id);

        if (!$sekolah) {
            return redirect()->to('admin/sekolah')->with('error', 'Data sekolah tidak ditemukan');
        }

        if (!$this->validate([
            'nama_sekolah'  => 'required',
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'kecamatan'     => 'required',
            'foto'          => 'permit_empty|max_size[foto,2048]|is_image[foto]',
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
        $this->SekolahModel->update($id,[
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'npsn'          => $this->request->getPost('npsn') ?: null,
            'tahun_berdiri' => $this->request->getPost('tahun_berdiri') ?: null,
            'website'       => $this->request->getPost('website') ?: null,
            'alamat'        => $this->request->getPost('alamat'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'foto'          => $fotoName,
        ]);
        return redirect()->to('admin/sekolah')->with('success', 'Data sekolah berhasil diperbarui');
    }


    public function show($id)
    {

        $data['sekolah'] = $this->SekolahModel->find($id);

        if (!$data['sekolah']) {
            return redirect()->to('admin/v_index')->with('error', 'Data sekolah tidak ditemukan');
        }

        return view('control-panel/admin/sekolah/v_detail', $data);
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

        $this->SekolahModel->delete($id);
        return redirect()->to('admin/sekolah')->with('success', 'Data sekolah berhasil dihapus');
    }

    public function peta()
    {
        $data['sekolah'] = $this->SekolahModel->findAll();
        $data['geojson'] = (new \App\Models\GeoJsonModel())->findAll();
        return view('control-panel/maps/v_peta_sekolah', $data);
    }
}
