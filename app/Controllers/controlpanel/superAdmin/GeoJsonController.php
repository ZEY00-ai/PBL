<?php

namespace App\Controllers\Controlpanel\superAdmin;

use App\Controllers\BaseController;
use App\Models\GeoJsonModel;
use CodeIgniter\HTTP\ResponseInterface;

class GeoJsonController extends BaseController
{
    protected GeoJsonModel $geoJsonModel;

    public function __construct()
    {
        $this->geoJsonModel = new GeoJsonModel();
    }

    public function index()
    {
        $data['geojson'] = $this->geoJsonModel->findAll();
        return view('control-panel/superAdmin/geoJson/v_index', $data);
    }

    public function create()
    {
        return view('control-panel/superAdmin/geoJson/v_create');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $geoJsonData = $this->request->getPost('geojson');
        if (!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        $this->geoJsonModel->insert([
            'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);

        return redirect()->to('superAdmin/geojson/list')->with('success', 'GeoJson berhasil disimpan');
    }

    public function edit($id)
    {
        $data['geojson'] = $this->geoJsonModel->find($id);

        if (!$data['geojson']) {
            return redirect()->back()->with('error', 'GeoJson tidak ditemukan');
        }

        return view('control-panel/superAdmin/geoJson/v_edit', $data);
    }
    //belum di kerjakan
    public function update($id)
    {
        if (!$this->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $geoJsonData = $this->request->getPost('geojson');
        if (!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        $this->geoJsonModel->update($id, [
            'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);

        return redirect()->to('superAdmin/geojson/list')->with('success', 'GeoJson berhasil diperbarui');
    }



    public function show($id)
    {
        $geojson = $this->geoJsonModel->find($id);

        if (!$geojson) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil sekolah berdasarkan kecamatan
        $sekolahModel = new \App\Models\SekolahModel();
        $sekolah      = $sekolahModel->where('kecamatan', $geojson['nama_kecamatan'])->findAll();

        $totalTK  = $sekolahModel->where('kecamatan', $geojson['nama_kecamatan'])->where('tingkatan', 'TK')->countAllResults();
        $totalSD  = $sekolahModel->where('kecamatan', $geojson['nama_kecamatan'])->where('tingkatan', 'SD')->countAllResults();
        $totalSMP = $sekolahModel->where('kecamatan', $geojson['nama_kecamatan'])->where('tingkatan', 'SMP')->countAllResults();


        $data['geojson'] = $geojson;
        $data['sekolah'] = $sekolah;
        $data['totalTK']  = $totalTK;
        $data['totalSD']  = $totalSD;
        $data['totalSMP'] = $totalSMP;

        return view('control-panel/superAdmin/geoJson/v_detail', $data);
    }


    public function destroy($id)
    {
        $data = $this->geoJsonModel->find($id);

        if (!$data) {
            return redirect()->to('superAdmin/geojson/list')->with('error', 'Data tidak ditemukan.');
        }

        $this->geoJsonModel->delete($id);
        return redirect()->to('superAdmin/geojson/list')->with('success', 'Data GeoJSON berhasil dihapus.');
    }

    public function peta()
    {
        $data['geojson'] = $this->geoJsonModel->findAll();
        $data['sekolah'] = (new \App\Models\SekolahModel())->findAll();
        return view('control-panel/maps/peta/v_peta', $data);
    }
}
