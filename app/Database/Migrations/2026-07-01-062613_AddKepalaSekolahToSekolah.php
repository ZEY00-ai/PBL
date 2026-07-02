<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKepalaSekolahToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'kepala_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'nama_sekolah',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', 'kepala_sekolah');
    }
}
