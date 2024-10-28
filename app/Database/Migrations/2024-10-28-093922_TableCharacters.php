<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCharacters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
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
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $this->forge->createTable('characters');
    }

    public function down()
    {
        $this->forge->dropTable('characters');
    }
}
