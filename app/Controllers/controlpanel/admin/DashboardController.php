<?php

namespace App\Controllers\Controlpanel\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $sekolahModel = new \App\Models\SekolahModel();
        $geoJsonModel = new \App\Models\GeoJsonModel();
        $userModel    = new \App\Models\UserModel();

        $data['totalSekolah']  = $sekolahModel->countAllResults();
        $data['totalGeoJson']  = $geoJsonModel->countAllResults();
        $data['totalAkun']     = $userModel->countAllResults();
        $data['totalKecamatan'] = $sekolahModel
            ->select('kecamatan')
            ->distinct()
            ->countAllResults();

        // 5 sekolah terbaru
        $data['sekolahTerbaru'] = $sekolahModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Sekolah per kecamatan
        $data['sekolahPerKecamatan'] = $sekolahModel
            ->select('kecamatan, COUNT(*) as total')
            ->groupBy('kecamatan')
            ->orderBy('total', 'DESC')
            ->findAll();

        return view('control-panel/admin/v_adminDashboard', $data);
    }
}
