<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_sekolah',
        'kepala_sekolah',
        'tingkatan',
        'akreditasi',
        'npsn',
        'nomor_sekolah',
        'email',
        'visi',
        'misi',
        'website',
        'alamat',
        'latitude',
        'longitude',
        'kecamatan',
        'geojson_id',
        'foto',
    ];
    protected $useTimestamps = true;

    public function getSekolahWithKecamatan()
    {
        return $this->select('sekolah.*, geojson.nama_kecamatan, geojson.warna')
            ->join('geojson', 'geojson.id = sekolah.geojson_id', 'left')
            ->findAll();
    }


    public function getSekolahDetailWithKecamatan($id)
    {
        return $this->select('sekolah.*, geojson.nama_kecamatan, geojson.warna')
            ->join('geojson', 'geojson.id = sekolah.geojson_id', 'left')
            ->where('sekolah.id', $id)
            ->first();
    }
}
