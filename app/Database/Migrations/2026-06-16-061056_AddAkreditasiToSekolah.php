<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAkreditasiToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'akreditasi' => [
                'type'       => 'ENUM',
                'constraint' => ['A', 'B', 'C', 'Belum Terakreditasi'],
                'null'       => true,
                'after'      => 'tingkatan',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', 'akreditasi');
    }   
}
