<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSekolahFields extends Migration
{
    public function up()
    {
        // Hapus kolom tahun_berdiri
        $this->forge->dropColumn('sekolah', 'tahun_berdiri');

        // Tambah kolom baru
        $this->forge->addColumn('sekolah', [
            'nomor_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'npsn',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'nomor_sekolah',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', ['nomor_sekolah', 'email']);

        $this->forge->addColumn('sekolah', [
            'tahun_berdiri' => [
                'type' => 'YEAR',
                'null' => true,
            ],
        ]);
    }
}
