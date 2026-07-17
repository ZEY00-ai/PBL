<?php

namespace App\Controllers;

use App\Models\SekolahModel;
use App\Models\GeoJsonModel;

class Home extends BaseController
{
    public function index()
    {
        // Cek kalau user sudah login → redirect sesuai role, gak usah lanjut query
        if (session()->get('logged_in')) {
            switch (session()->get('user_role')) {
                case 'super_admin':
                    return redirect()->to('/dashboard');

                case 'admin':
                    return redirect()->to('/admin/profileSekolah');
            }
        }

        $sekolahModel = new SekolahModel();
        $geoJsonModel = new GeoJsonModel();

        $data['sekolah'] = $sekolahModel->findAll();
        $data['geojson'] = $geoJsonModel->findAll();

        $data['totalSekolah'] = $sekolahModel->countAllResults();
        $data['totalTK']      = $sekolahModel->where('tingkatan', 'TK')->countAllResults();
        $data['totalSD']      = $sekolahModel->where('tingkatan', 'SD')->countAllResults();
        $data['totalSMP']     = $sekolahModel->where('tingkatan', 'SMP')->countAllResults();

        return $this->response
            ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->setHeader('Pragma', 'no-cache')
            ->setHeader('Expires', '0')
            ->setBody(view('control-panel/landing_page', $data));
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
        $geoJsonModel = new \App\Models\GeoJsonModel();
        $sekolah      = $sekolahModel->find($id);


        if (!$sekolah) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sekolah tidak ditemukan.');
        }

        // ambil parameter 'from' dari query string, misal ?from=admin
        $from = $this->request->getGet('from');

        // tentukan url tombol kembali
        if ($from === 'superAdmin') {
            $backUrl = base_url('superAdmin/sekolah'); // ganti sesuai route halaman super admin lo
        } elseif ($from === 'fullmap') {
            $backUrl = base_url('peta');
        } else {
            $backUrl = base_url('/'); // default balik ke beranda
        }

        return view('control-panel/detail_sekolah', [
            'sekolah' => $sekolah,
            'geojson' => $geoJsonModel->findAll(),
            'backUrl' => $backUrl,
        ]);
    }
}
