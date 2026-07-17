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
        // mengambil semua data geojson dari model GeoJsonModel
        $data['geojson'] = $this->geoJsonModel->findAll();
        return view('control-panel/superAdmin/geoJson/v_index', $data);
    }

    public function create()
    {
        return view('control-panel/superAdmin/geoJson/v_create');
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama_kecamatan' => 'required', //wajib
            'geojson' => 'required',//wajib
        ])) {
            // Jika validasi gagal, kembali ke halaman sebelumnya 
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $namakecamatan = $this->request->getPost('nama_kecamatan');
        
        // Cek duplikat kecamatan
        $existing = $this->geoJsonModel->where('nama_kecamatan', $namakecamatan)->first();
        if ($existing) {
            return redirect()->back()->withInput()->with('error', 'GeoJson untuk kecamatan "' . esc($namakecamatan) . '" sudah ada. Hanya boleh 1 GeoJson per kecamatan.');
        }

        // Ambil data GeoJson dari form dan validasi
        $geoJsonData = $this->request->getPost('geojson');
        // Validasi GeoJson, jika tidak valid, kembali ke halaman sebelumnya 
        if (!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        // Simpan data ke database
        $this->geoJsonModel->insert([
            'nama_kecamatan' => $namakecamatan,
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);

        return redirect()->to('superAdmin/geojson/list')->with('success', 'GeoJson berhasil disimpan');
    }

    public function edit($id)
    {
        // Ambil data GeoJson berdasarkan ID
        $data['geojson'] = $this->geoJsonModel->find($id);

        // Jika data tidak ditemukan, kembali ke halaman sebelumnya 
        if (!$data['geojson']) {
            return redirect()->back()->with('error', 'GeoJson tidak ditemukan');
        }

        return view('control-panel/superAdmin/geoJson/v_edit', $data);
    }

    public function update($id)
    {
        //sama dengan di atas
        if (!$this->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $namakecamatan = $this->request->getPost('nama_kecamatan');
        
        // Cek duplikat kecamatan (exclude record saat ini)
        $existing = $this->geoJsonModel->where('nama_kecamatan', $namakecamatan)->where('id !=', $id)->first();
        if ($existing) {
            return redirect()->back()->withInput()->with('error', 'GeoJson untuk kecamatan "' . esc($namakecamatan) . '" sudah ada. Hanya boleh 1 GeoJson per kecamatan.');
        }

        $geoJsonData = $this->request->getPost('geojson');
        if (!json_decode($geoJsonData)) {
            return redirect()->back()->withInput()->with('error', 'GeoJson tidak valid');
        }

        $this->geoJsonModel->update($id, [
            'nama_kecamatan' => $namakecamatan,
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geoJsonData,
        ]);

        return redirect()->to('superAdmin/geojson/list')->with('success', 'GeoJson berhasil diperbarui');
    }



    public function show($id)
    {
        // Ambil data GeoJson berdasarkan ID
        $geojson = $this->geoJsonModel->find($id);

        //sama dengan di atas
        if (!$geojson) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil sekolah berdasarkan kecamatan
        $sekolahModel = new \App\Models\SekolahModel();
        $sekolah      = $sekolahModel->where('kecamatan', $geojson['nama_kecamatan'])->findAll();

        // Hitung total sekolah per tingkatan di kecamatan tersebut
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
        /// Ambil data GeoJson berdasarkan ID
        $data = $this->geoJsonModel->find($id);

        //sama dengan di atas
        if (!$data) {
            return redirect()->to('superAdmin/geojson/list')->with('error', 'Data tidak ditemukan.');
        }

        $this->geoJsonModel->delete($id);
        return redirect()->to('superAdmin/geojson/list')->with('success', 'Data GeoJSON berhasil dihapus.');
    }

    public function peta()
    {
        // Ambil semua data GeoJson dan Sekolah untuk ditampilkan di peta
        $data['geojson'] = $this->geoJsonModel->findAll();
        $data['sekolah'] = (new \App\Models\SekolahModel())->findAll();
        return view('control-panel/maps/peta/v_peta', $data);
    }
}
