<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTingkatanToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'tingkatan' => [
                'type'       => 'ENUM',
                'constraint' => ['TK', 'SD', 'SMP'],
                'null'       => true,
                'after'      => 'nama_sekolah',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', 'tingkatan');
    }
}
