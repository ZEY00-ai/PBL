<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropRoleFromUsers extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('users', 'role');
    }

    public function down()
    {
        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin_sistem', 'operator_dinas', 'operator_maps'],
                'default'    => 'operator_maps',
                'after'      => 'password',
            ],
        ]);
    }
}
