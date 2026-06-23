<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGeojsonIdToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'geojson_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'kecamatan',
            ],
        ]);

        // Tambah foreign key
        $this->forge->addForeignKey('geojson_id', 'geojson', 'id', 'SET NULL', 'CASCADE', 'sekolah');
        $this->forge->processIndexes('sekolah');
    }

    public function down()
    {
        $this->forge->dropForeignKey('sekolah', 'sekolah_geojson_id_foreign');
        $this->forge->dropColumn('sekolah', 'geojson_id');
    }
}
 