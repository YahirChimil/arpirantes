<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SedesModel;
use App\Models\CarrerasSedesModel;

class Sedes extends BaseController
{
    public function index()
    {
        //
    }
    public function getSedes() {
        $sedeModel = new SedesModel();
        $sedes = $sedeModel->findAll(); // Obtiene todas las sedes
        return $this->response->setJSON($sedes); // Devuelve como JSON
    }

    public function getCarrerasPorSede($id_sede) {
        $builder = db_connect()->table('carreras_sedes');
        $carreras = $builder
            ->join('carreras', 'carreras.id = carreras_sedes.id_carrera')
            ->where('id_sede', $id_sede)
            ->select('carreras.id, carreras.nombre')
            ->get()
            ->getResultArray();
        
        return $this->response->setJSON($carreras);
    }

    

}
