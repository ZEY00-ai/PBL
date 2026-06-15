<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_sekolah',
        'npsn',
        'tahun_berdiri',
        'website',
        'alamat',
        'latitude',
        'longitude',
        'kecamatan',
        'foto',
    ];
    protected $useTimestamps = true;
}
