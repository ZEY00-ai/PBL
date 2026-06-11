<?php

namespace App\Models;

use CodeIgniter\Model;

class GeoJsonModel extends Model
{
    protected $table = 'geojson';
    protected $allowedFields = ['nama_kecamatan', 'warna', 'geojson'];
    protected $useTimestamps = true;
    
}
