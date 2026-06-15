<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'npsn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'nama_sekolah',
            ],
            'tahun_berdiri' => [
                'type'       => 'YEAR',
                'null'       => true,
                'after'      => 'npsn',
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'tahun_berdiri',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', ['npsn', 'tahun_berdiri', 'website']);
    }
}
