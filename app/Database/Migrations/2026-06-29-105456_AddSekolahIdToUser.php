<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSekolahIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'sekolah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'role',
            ],
        ]);

        $this->forge->addForeignKey(
            'sekolah_id',
            'sekolah',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->processIndexes('users');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users', 'users_sekolah_id_foreign');
        $this->forge->dropColumn('users', 'sekolah_id');
    }
}