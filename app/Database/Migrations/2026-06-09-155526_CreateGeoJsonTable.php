<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGeoJsonTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'warna' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'geojson' => [
                'type' => 'LONGTEXT',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('geojson');
    }

    public function down()
    {
        $this->forge->dropTable('geojson');
    }
}
