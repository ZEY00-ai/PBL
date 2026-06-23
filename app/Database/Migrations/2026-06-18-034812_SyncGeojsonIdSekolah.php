<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SyncGeojsonIdSekolah extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $geojsonList = $db->table('geojson')->get()->getResultArray();

        foreach ($geojsonList as $g) {
            $db->table('sekolah')
                ->where('kecamatan', $g['nama_kecamatan'])
                ->update(['geojson_id' => $g['id']]);
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $db->table('sekolah')->update(['geojson_id' => null]);
    }
}
