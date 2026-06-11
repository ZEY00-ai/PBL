<?php

namespace App\Controllers\Controlpanel\Admin;

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
        return view('control-panel/maps/input/v_geoJson');
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $geoJsonData = $this->request->getPost('geojson');
        if(!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        $this->geoJsonModel->insert([
            'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);
        
        return redirect()->back()->with('success', 'GeoJson berhasil disimpan');
    }

    public function peta()
    {
        $data['geojson'] = $this->geoJsonModel->findAll();
        $data['sekolah'] = (new \App\Models\SekolahModel())->findAll();
        return view('control-panel/maps/peta/v_peta', $data);
    }

    public function hapus($id)
    {
        $this->geoJsonModel->delete($id);
        return redirect()->back()->with('success', 'GeoJson berhasil dihapus');
    }

    public function list()
    {
        $data['geojson'] = $this->geoJsonModel->findAll();
        return view('control-panel/maps/list/v_list_geoJson', $data);
    }

    public function edit($id)
    {
        $data['geojson'] = $this->geoJsonModel->find($id);

        if (!$data['geojson']) {
            return redirect()->back()->with('error', 'GeoJson tidak ditemukan');
        }

        return view('control-panel/maps/edit/v_edit_geoJson', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $geoJsonData = $this->request->getPost('geojson');
        if(!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        $this->geoJsonModel->update($id, [
            'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);
        
        return redirect()->back()->with('success', 'GeoJson berhasil diperbarui');
    }
}
