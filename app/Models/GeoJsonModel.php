<?php

namespace App\Models;

use CodeIgniter\Model;

class GeoJsonModel extends Model
{
    protected $table         = 'geojson';
    protected $allowedFields = ['nama_kecamatan', 'warna', 'geojson'];
    protected $useTimestamps = true;

    /**
     * Ambil sekolah berdasarkan geojson_id (relasi)
     */
    public function getSekolahByKecamatan($geojsonId)
    {
        return (new SekolahModel())->where('geojson_id', $geojsonId)->findAll();
    }
}
