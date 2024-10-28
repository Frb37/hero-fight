<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCharacters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'strength' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'constitution' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'agility' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'experience' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'level' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $this->forge->addUniqueKey(['user_id', 'name']);
        $this->forge->createTable('characters');
    }

    public function down()
    {
        $this->forge->dropTable('characters');
    }
}
