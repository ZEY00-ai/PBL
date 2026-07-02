<?php

namespace App\Controllers;

use App\Models\SekolahModel;
use App\Models\GeoJsonModel;

class Home extends BaseController
{
    public function index()
    {
        $sekolahModel = new SekolahModel();
        $geoJsonModel = new GeoJsonModel();

        $data['sekolah'] = $sekolahModel->findAll();
        $data['geojson'] = $geoJsonModel->findAll();

        $data['totalSekolah'] = $sekolahModel->countAllResults();
        $data['totalTK']      = $sekolahModel->where('tingkatan', 'TK')->countAllResults();
        $data['totalSD']      = $sekolahModel->where('tingkatan', 'SD')->countAllResults();
        $data['totalSMP']     = $sekolahModel->where('tingkatan', 'SMP')->countAllResults();

        return view('control-panel/landing_page', $data);
    }

    public function petaFull()
    {
        $sekolahModel = new \App\Models\SekolahModel();
        $geoJsonModel = new \App\Models\GeoJsonModel();

        $data['sekolah'] = $sekolahModel->findAll();
        $data['geojson'] = $geoJsonModel->findAll();

        return view('control-panel/peta_full', $data);
    }

    public function sekolahDetail($id)
    {
        $sekolahModel = new \App\Models\SekolahModel();
        $sekolah      = $sekolahModel->find($id);

        if (!$sekolah) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sekolah tidak ditemukan.');
        }

        return view('control-panel/detail_sekolah', ['sekolah' => $sekolah]);
    }
}
