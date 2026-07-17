<?php

namespace App\Controllers\Controlpanel\superAdmin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $sekolahModel = new \App\Models\SekolahModel(); // Menggunakan model SekolahModel
        $geoJsonModel = new \App\Models\GeoJsonModel(); // Menggunakan model GeoJsonModel
        $userModel    = new \App\Models\UserModel(); // Menggunakan model UserModel

        // Menghitung total sekolah, total TK, total SD, total SMP, total GeoJson, total akun, dan total kecamatan
        $data['totalSekolah']  = $sekolahModel->countAllResults();
        $data['totalTK']       = $sekolahModel->where('tingkatan', 'TK')->countAllResults();
        $data['totalSD']       = $sekolahModel->where('tingkatan', 'SD')->countAllResults();
        $data['totalSMP']      = $sekolahModel->where('tingkatan', 'SMP')->countAllResults();
        // $data['totalGeoJson']  = $geoJsonModel->countAllResults();
        // $data['totalAkun']     = $userModel->countAllResults();
        // Menghitung total kecamatan dengan menghitung jumlah kecamatan unik di tabel sekolah
        $data['totalKecamatan'] = $sekolahModel->select('kecamatan')->distinct()->countAllResults();

        $data['sekolah'] = $sekolahModel->findAll(); // Mengambil semua data sekolah
        $data['geojson'] = $geoJsonModel->findAll(); // Mengambil semua data geojson

        // Mengambil data sekolah per kecamatan dengan menghitung jumlah sekolah per kecamatan
        $data['sekolahPerKecamatan'] = $sekolahModel
            ->select('kecamatan, COUNT(*) as total')
            ->groupBy('kecamatan')
            ->orderBy('total', 'DESC')
            ->findAll();

        return view('control-panel/admin/v_adminDashboard', $data);
    }
}
