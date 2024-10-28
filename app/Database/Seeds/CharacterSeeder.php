<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CharacterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Pikachu', 'strength' => 10, 'constitution' => 7, 'agility' => 19, 'experience' => 0, 'level' => 1],
            ['name' => 'Incineroar', 'strength' => 22, 'constitution' => 15, 'agility' => 10, 'experience' => 200, 'level' => 5],
            ['name' => 'Samus Aran', 'strength' => 18, 'constitution' => 19, 'agility' => 12, 'experience' => 150, 'level' => 4],
            ['name' => 'Kraid', 'strength' => 21, 'constitution' => 15, 'agility' => 4, 'experience' => 550, 'level' => 12],
            ['name' => 'Ridley', 'strength' => 16, 'constitution' => 10, 'agility' => 25, 'experience' => 600, 'level' => 13],
            ['name' => 'Mario', 'strength' => 6, 'constitution' => 10, 'agility' => 14, 'experience' => 0, 'level' => 1],
            ['name' => 'Luigi', 'strength' => 6, 'constitution' => 7, 'agility' => 19, 'experience' => 0, 'level' => 1],
            ['name' => 'Toad', 'strength' => 4, 'constitution' => 7, 'agility' => 19, 'experience' => 0, 'level' => 1],
            ['name' => 'Princess Peach', 'strength' => 10, 'constitution' => 7, 'agility' => 19, 'experience' => 0, 'level' => 1],
            ['name' => 'Topi Taupe', 'strength' => 10, 'constitution' => 7, 'agility' => 19, 'experience' => 0, 'level' => 1],
        ];

        $this->db->table('characters')->insertBatch($data);
    }
}
