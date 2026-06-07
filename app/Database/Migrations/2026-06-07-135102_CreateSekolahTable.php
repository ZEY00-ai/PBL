<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSekolahTable extends Migration
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
        'nama_sekolah' => [
            'type'       => 'VARCHAR',
            'constraint' => 200,
        ],
        'alamat' => [
            'type' => 'TEXT',
        ],
        'latitude' => [
            'type'       => 'DECIMAL',
            'constraint' => '10,8',
        ],
        'longitude' => [
            'type'       => 'DECIMAL',
            'constraint' => '11,8',
        ],
        'kecamatan' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],
        'foto' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('sekolah');
}

public function down()
{
    $this->forge->dropTable('sekolah');
}
}
