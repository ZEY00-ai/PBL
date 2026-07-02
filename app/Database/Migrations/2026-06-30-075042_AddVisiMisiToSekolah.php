<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisiMisiToSekolah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sekolah', [
            'visi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'email',
            ],
            'misi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'visi',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', ['visi', 'misi']);
    }
}
