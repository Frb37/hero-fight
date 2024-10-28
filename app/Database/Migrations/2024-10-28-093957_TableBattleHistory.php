<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableBattleHistory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'character_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'action' => [
                'type' => 'VARCHAR',
            ],
            'result' => [
                'type' => 'VARCHAR',
            ],
            'timestamp' => [
                'type' => 'DATETIME',
            ]
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('character_id', 'characters', 'id');
        $this->forge->createTable('battle_history');
    }

    public function down()
    {
        $this->forge->dropTable('battle_history');
    }
}
