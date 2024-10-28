<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'user_one',
                'email'        => 'userone@example.com',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'id_permission' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'user_two',
                'email'        => 'usertwo@example.com',
                'password'     => password_hash('password456', PASSWORD_DEFAULT),
                'id_permission' => 2,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'user_three',
                'email'        => 'userthree@example.com',
                'password'     => password_hash('password789', PASSWORD_DEFAULT),
                'id_permission' => 3,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'user_four',
                'email'        => 'userfour@example.com',
                'password'     => password_hash('password321', PASSWORD_DEFAULT),
                'id_permission' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'user_five',
                'email'        => 'userfive@example.com',
                'password'     => password_hash('password654', PASSWORD_DEFAULT),
                'id_permission' => 2,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
