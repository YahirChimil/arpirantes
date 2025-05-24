<?php

namespace App\Controllers;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\HTTP\RequestInterface;


class Repositorio extends BaseController
{   
    
    public function nuevo()
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Repositorio';
            $data['miga'] = 'Repositorio';
            $data['url_miga'] = base_url() . '';
            $data['sub_miga'] = 'nuevo';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();

            $db = db_connect();
            $query = $db->query('SELECT id, clasificacion, tema FROM ciit_clasificaciones where deleted = 0 order by clasificacion, tema');
            $db->close(); 
            $data['clasificacion'] = $query->getResultArray();

            $db = db_connect();
            $query = $db->query('SELECT id, clave_inegi, nombre FROM ciit_estados where deleted = 0 order by nombre');
            $db->close(); 
            $data['estados'] = $query->getResultArray();

            if($_POST){
                
                $nombre = trim($this->request->getVar('nombre'));
                $estatus = $this->request->getVar('estatus');
                $array_estado = $this->request->getVar('estado');
                $estado = implode(",",$array_estado) ;
                $array_temas =  $this->request->getVar('clasificacion');
                $temas = implode(",", $array_temas);
                $descripcion = trim($this->request->getVar('descripcion'));
                $confirmo = $this->request->getVar('confirmo');
                
                $db = db_connect();
                $db->query('INSERT INTO ciit_repositorio(uuid, usuario, nombre, estatus, estado, temas, descripcion, confirmacion) values ( uuid(),
                "'.$data['user_info']['id'].'",
                "'.$nombre.'",
                "'.$estatus.'",
                "'.$estado.'",
                "'.$temas.'",
                "'.$descripcion.'",
                "'.$confirmo.'"
                )');
                $id = $db->insertID();
                $db->close();
                return redirect()->to(site_url('Repositorio/ver/'.$id));

            } else { return view('repositorio/nuevo', $data); }
            
            

        } else {
            return redirect()->to(site_url('/'));
        }
    }
    public function ver($id)
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Repositorio';
            $data['miga'] = 'Repositorio';
            $data['url_miga'] = base_url() . '';
            $data['sub_miga'] = 'ver';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();

            $db = db_connect();
            $query = $db->query('SELECT ciit_repositorio.*, users.username, users.nombre as autor, users.foto FROM ciit_repositorio left join users on ciit_repositorio.usuario=users.id where deleted = 0 and ciit_repositorio.id = '.$id);
            $db->close(); 
            $data_repositorio = $query->getResultArray(); 
            $data['repositorio'] = $data_repositorio[0];

            $db = db_connect();
            $query = $db->query('SELECT clasificacion, tema FROM ciit_clasificaciones where deleted = 0 and id in ('. $data_repositorio[0]['temas'].')');
            $db->close(); 
            $data['temas'] = $query->getResultArray(); 

            $db = db_connect();
            $query = $db->query('SELECT nombre FROM ciit_estados where deleted = 0 and id in ('. $data_repositorio[0]['estado'].')');
            $db->close(); 
            $data['estados'] = $query->getResultArray(); 


            $data['titulo'] =  $data['titulo'].': '.$data['repositorio']['nombre'];
            $data['sub_miga'] = $data['sub_miga'].': '.$data['repositorio']['uuid'];

            return view('repositorio/ver', $data); 
            
            

        } else {
            return redirect()->to(site_url('/'));
        }
    }
    public function busqueda_general()
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Repositorio';
            $data['miga'] = 'Repositorio';
            $data['url_miga'] = base_url() . '';
            $data['sub_miga'] = 'Busqueda general';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();

            $db = db_connect();
            $query = $db->query('SELECT ciit_repositorio.*, users.username, users.nombre as autor, users.foto FROM ciit_repositorio left join users on ciit_repositorio.usuario=users.id where deleted = 0');
            $db->close(); 
            $data_repositorio = $query->getResultArray(); 
            $data['repositorios'] = $data_repositorio;

            return view('repositorio/busqueda_general', $data); 
            
            

        } else {
            return redirect()->to(site_url('/'));
        }
    }
}
