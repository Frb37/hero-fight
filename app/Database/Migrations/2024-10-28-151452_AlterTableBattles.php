<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableBattles extends Migration
{
    public function up()
    {
        $this->forge->addForeignKey('character1_id', 'characters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('character2_id', 'characters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('winner_id', 'characters', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('loser_id', 'characters', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('battles', 'battles_character1_id_foreign');
        $this->forge->dropForeignKey('battles', 'battles_character2_id_foreign');
        $this->forge->dropForeignKey('battles', 'battles_winner_id_foreign');
        $this->forge->dropForeignKey('battles', 'battles_loser_id_foreign');
    }

}
