<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableCharactersAllowNull extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('characters', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => null,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
