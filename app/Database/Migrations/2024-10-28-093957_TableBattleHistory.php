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
                'unsigned' => true,
            ],
            'character_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'result' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'timestamp' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $this->forge->addForeignKey('character_id', 'characters', 'id');
        $this->forge->createTable('battle_history');
    }

    public function down()
    {
        $this->forge->dropTable('battle_history');
    }
}
