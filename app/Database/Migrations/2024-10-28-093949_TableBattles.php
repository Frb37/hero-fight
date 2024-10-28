<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableBattles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'character1_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'character2_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'winner_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'loser_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ]
        ]);
        $this->forge->createTable('battles');
    }

    public function down()
    {
        $this->forge->dropTable('battles');
    }
}
