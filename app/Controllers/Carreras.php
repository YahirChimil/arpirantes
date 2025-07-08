<?php

namespace App\Controllers;

use App\Models\CarrerasModel;
use CodeIgniter\Controller;

class Carreras extends Controller
{
    public function getCarreras()
    {
        $model = new CarrerasModel();
        $carreras = $model->findAll();
        return $this->response->setJSON($carreras);
    }



    public function getCarrerasPorSede($id_sede)
{
    $model = new CarrerasModel();

    if ($id_sede == 1) {
        // Instituto Tecnológico de Oaxaca: todas las carreras
        $carreras = $model->findAll();
    } else {
        // Extensión Tlacolula: solo dos específicas
        $carreras = $model->whereIn('nombre', [
            'Ingeniería Civil',
            'Ingeniería en Gestión Empresarial'
        ])->findAll();
    }

    return $this->response->setJSON($carreras);
}






}

