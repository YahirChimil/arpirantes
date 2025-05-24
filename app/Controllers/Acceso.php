<?php

namespace App\Controllers;
use CodeIgniter\Shield\Entities\User;


class Acceso extends BaseController
{   
    public function index()
    {
        if (auth()->loggedIn()) {  
            return redirect()->to(site_url('Acceso/principal'));
        } else { 
            return view('acceso/login'); 
        }
        
    }
    public function principal()
    {
        if (auth()->loggedIn()) {

            $data['titulo'] = 'Principal';
            $data['miga'] = 'Tableros';
            $data['url_miga'] = base_url() . 'principal';
            $data['sub_miga'] = 'inicio';
            $data['user_info'] = datos_usuario();

            return view('base/vista_base', $data);

        } else {
            return redirect()->to(site_url('Acceso/login'));
        }
    }
    public function login()
    {
        $credentials = [
            'username'    => $this->request->getPost('usuario'),
            'password' => $this->request->getPost('contrasena')
        ];
        $loginAttempt = auth()->attempt($credentials);
        
        if (! $loginAttempt->isOK()) {
            $data['error'] =  $loginAttempt->reason(); 
            print_r($data);
        } else {
            return redirect()->to(site_url('/'));
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->to(site_url('/'));
    }

    public function new_user()
    {
        //control para crear usuario al vuelo
        //return view('Acceso/principal');
        $users = auth()->getProvider();
        /*
        |  niveles de usuario:
        |  0 developer
        |  1 administradores
        |  2 docente
        |  3 alumno
        |  4 aspirante
        |
        */
        $user = new User([
            'username' => 'admin',
            'email'    => 'ricardo@itoaxaca.edu.mx',
            'password' => '4m4r4l3101',
        ]);
        $users->save($user);
        // To get the complete user object with ID, we need to get from the database
        print_r($users->findById($users->getInsertID())) ;
    }
}
