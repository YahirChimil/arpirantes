<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class UserSeeder extends Seeder

{
    public function run()
    {
        $users = new UserModel();

        // Crear un usuario
        $user = new User([
            'username' => 'admin',
            'email'    => 'ricardo@itoaxaca.edu.mx',
            'password' => '4m4r4l3101', // Shield se encarga del hash
        ]);

        $users->save($user);

        echo "Usuario admin creado ✅\n";
    }
}
