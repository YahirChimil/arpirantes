<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Asignacion extends BaseController
{
    public function index()
    {
        // Solo administradores pueden acceder
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
        }

        $grupoModel = new \App\Models\GruposExamenModel();

        $grupos = $grupoModel
            ->select('grupos_examen.*, sedes.nombre_sede, carreras.nombre AS nombre_carrera')
            ->join('sedes', 'sedes.id_sede = grupos_examen.sede_id')
            ->join('carreras', 'carreras.id = grupos_examen.carrera_id')
            ->findAll();

        $data = [
            'titulo'     => 'Asignar Aspirantes a Grupos',
            'miga'       => 'Administración',
            'url_miga'   => base_url('asignacion'),
            'sub_miga'   => 'asignacion',
            'user_info'  => datos_usuario(),
            'grupos'     => $grupos
        ];

        return view('base/administrador/asignar_aspirantes', $data);
    }
}
