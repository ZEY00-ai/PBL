<?php

namespace App\Controllers\Controlpanel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SekolahController extends BaseController
{

    protected $sekolahModel;
    public function __construct()
    {
        $this->sekolahModel = new \App\Models\SekolahModel();
    }

    public function tambah()
    {
        return view('control-panel/maps/v_input');
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_sekolah'  => 'required',
            'alamat'        => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'kecamatan'     => 'required',
            'foto'          => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

      $fotoName = null;
      $foto = $this->request->getFile('foto');
      if ($foto && $foto->isValid() && !$foto->hasMoved()) {
          $fotoName = $foto->getRandomName();
          $foto->move(ROOTPATH . 'public/uploads/sekolah', $fotoName);
      }

        $this->sekolahModel->insert([
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat'       => $this->request->getPost('alamat'),
            'latitude'     => $this->request->getPost('latitude'),
            'longitude'    => $this->request->getPost('longitude'),
            'kecamatan'    => $this->request->getPost('kecamatan'),
            'foto'         => $fotoName,
        ]);

        return redirect()->to('/operator-maps/dashboard')->with('success', 'Data sekolah berhasil disimpan');
    }

    public function peta()
    {
        $data['sekolah'] = $this->sekolahModel->findAll();
        return view('control-panel/maps/v_peta_sekolah', $data);
    }


}
