<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Files\File;


class Recurso extends BaseController
{

    public function nuevo($id)
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Recurso';
            $data['miga'] = 'Recurso';
            $data['url_miga'] = base_url() . '';
            $data['sub_miga'] = 'nuevo';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();

            $data['id'] = $id;
            return view('recurso/nuevo', $data);
        } else {
            return redirect()->to(site_url('/'));
        }
    }
    public function agregar_link($id,$tipo_recurso_clave)
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Agregar '.$tipo_recurso_clave;
            $data['miga'] = 'Repositorio';
            $data['url_miga'] = base_url() . 'Recurso/nuevo/'.$id;
            $data['sub_miga'] = 'nuevo recurso';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();
            $tipo_recurso=$tipo_recurso_clave;
            $id_repositorio=$id;

            if($_POST){
                
                if(isset($_POST['nombre'])) { $nombre = trim($this->request->getVar('nombre')); } else { $nombre = NULL; } 
                if(isset($_POST['descripcion'])) { $descripcion = trim($this->request->getVar('descripcion')); } else { $descripcion = NULL; } 
                if(isset($_POST['lat'])) { $lat = trim($this->request->getVar('lat')); } else { $lat = NULL; } 
                if(isset($_POST['lon'])) { $lon = trim($this->request->getVar('lon')); } else { $lon = NULL; } 
                if(isset($_POST['link'])) { $link = trim($this->request->getVar('link')); } else { $link = NULL; } 
                if(isset($_POST['tags'])) { $tags = trim($this->request->getVar('tags')); } else { $tags = NULL; } 
                if(isset($_POST['fecha_inicio']))  { $fecha_inicio = trim($this->request->getVar('fecha_inicio')); } else { $fecha_inicio = NULL; } 
                if(isset($_POST['fecha_fin'])) { $fecha_fin = trim($this->request->getVar('fecha_fin')); } else { $fecha_fin = NULL; } 

                

                if (empty ($_FILES)){
                    $archivo = '';
                    $archivo_tipo = '';
                } else {

                    $objeto_archivo = $this->request->getFile('archivo');
                    $filepath = WRITEPATH . 'uploads/' . $objeto_archivo->store();
                    $nombre_encriptado = $objeto_archivo->getName();
                    rename($filepath, FCPATH.'uploads/'.$nombre_encriptado);
                    $archivo = $nombre_encriptado;
                    $archivo_tipo = '';
                }
                


                $db = db_connect();
                $db->query('INSERT INTO ciit_recurso(uuid, usuario, nombre, descripcion, archivo, archivo_tipo, lat, lon, link, tags,fecha_inicio, fecha_fin, id_repositorio, tipo_recurso) values ( uuid(),
                "'.$data['user_info']['id'].'",
                "'.$nombre.'",
                "'.$descripcion.'",
                "'.$archivo.'",
                "'.$archivo_tipo.'",
                "'.$lat.'",
                "'.$lon.'",
                "'.$link.'",
                "'.$tags.'",
                "'.$fecha_inicio.'",
                "'.$fecha_fin.'",
                "'.$id_repositorio.'",
                "'.$tipo_recurso.'"
                )');
                
                $db->close();
                return redirect()->to(site_url('Repositorio/ver/'.$id));

            } else {
                switch ($tipo_recurso_clave) {
                    case 'link':
                        return view('recurso/agregar_link', $data);
                        break;
                    case 'csv':
                        return view('recurso/agregar_csv', $data);
                        break;
                    case 'excel':
                        return view('recurso/agregar_excel', $data);
                        break;
                    case 'evento':
                        return view('recurso/agregar_evento', $data);
                        break;
                    case 'kml':
                        return view('recurso/agregar_kml', $data);
                        break;
                    case 'geojson':
                        return view('recurso/agregar_geojson', $data);
                        break;
                    case 'coordenada':
                        return view('recurso/agregar_coordenada', $data);
                        break;
                    case 'municipio':
                        return view('recurso/agregar_municipio', $data);
                        break;
                    case 'doc':
                        return view('recurso/agregar_doc', $data);
                        break;
                    case 'imagen':
                        return view('recurso/agregar_imagen', $data);
                        break;
                    case 'correo':
                        return view('recurso/agregar_correo', $data);
                        break;
                    case 'audio':
                        return view('recurso/agregar_audio', $data);
                        break;
                    case 'pdf':
                        return view('recurso/agregar_pdf', $data);
                        break;
                    case 'pptx':
                        return view('recurso/agregar_pptx', $data);
                        break;
                    case 'sql':
                        return view('recurso/agregar_sql', $data);
                        break;
                    case 'video':
                        return view('recurso/agregar_video', $data);
                        break;
                    case 'zip':
                        return view('recurso/agregar_zip', $data);
                        break;
                    default:
                        return view('recurso/agregar_link', $data);
                        break;
                }
                
            
            }
            
            

        } else {
            return redirect()->to(site_url('/'));
        }
    }
    public function agregar_articulo($id,$tipo_recurso_clave)
    {
        if (auth()->loggedIn()) {
            $data['titulo'] = 'Agregar '.$tipo_recurso_clave;
            $data['miga'] = 'Repositorio';
            $data['url_miga'] = base_url() . 'Recurso/nuevo/'.$id;
            $data['sub_miga'] = 'nuevo recurso';
            $data['user_info'] = datos_usuario();
            $request = service('request');
            $ip_origen = $request->getIPAddress();
            $tipo_recurso=$tipo_recurso_clave;
            $id_repositorio=$id;

            if($_POST){
                
                if(isset($_POST['nombre'])) { $nombre = trim($this->request->getVar('nombre')); } else { $nombre = NULL; } 
                if(isset($_POST['descripcion'])) { $descripcion = trim($this->request->getVar('descripcion')); } else { $descripcion = NULL; } 
                if(isset($_POST['lat'])) { $lat = trim($this->request->getVar('lat')); } else { $lat = NULL; } 
                if(isset($_POST['lon'])) { $lon = trim($this->request->getVar('lon')); } else { $lon = NULL; } 
                if(isset($_POST['link'])) { $link = trim($this->request->getVar('link')); } else { $link = NULL; } 
                if(isset($_POST['tags'])) { $tags = trim($this->request->getVar('tags')); } else { $tags = NULL; } 
                if(isset($_POST['fecha_inicio']))  { $fecha_inicio = trim($this->request->getVar('fecha_inicio')); } else { $fecha_inicio = NULL; } 
                if(isset($_POST['fecha_fin'])) { $fecha_fin = trim($this->request->getVar('fecha_fin')); } else { $fecha_fin = NULL; } 

                

                if (empty ($_FILES)){
                    $archivo = '';
                    $archivo_tipo = '';
                } else {

                    $objeto_archivo = $this->request->getFile('archivo');
                    $filepath = WRITEPATH . 'uploads/' . $objeto_archivo->store();
                    $nombre_encriptado = $objeto_archivo->getName();
                    rename($filepath, FCPATH.'uploads/'.$nombre_encriptado);
                    $archivo = $nombre_encriptado;
                    $archivo_tipo = '';
                }
                


                $db = db_connect();
                $db->query('INSERT INTO ciit_recurso(uuid, usuario, nombre, descripcion, archivo, archivo_tipo, lat, lon, link, tags,fecha_inicio, fecha_fin, id_repositorio, tipo_recurso) values ( uuid(),
                "'.$data['user_info']['id'].'",
                "'.$nombre.'",
                "'.$descripcion.'",
                "'.$archivo.'",
                "'.$archivo_tipo.'",
                "'.$lat.'",
                "'.$lon.'",
                "'.$link.'",
                "'.$tags.'",
                "'.$fecha_inicio.'",
                "'.$fecha_fin.'",
                "'.$id_repositorio.'",
                "'.$tipo_recurso.'"
                )');
                
                $db->close();
                return redirect()->to(site_url('Repositorio/ver/'.$id));

            } else {
                switch ($tipo_recurso_clave) {
                    case 'articulo':
                        return view('recurso/agregar_articulo', $data);
                        break;
                    
                    default:
                        return view('recurso/agregar_articulo', $data);
                        break;
                }
                
            
            }
            
            

        } else {
            return redirect()->to(site_url('/'));
        }
    }

}
