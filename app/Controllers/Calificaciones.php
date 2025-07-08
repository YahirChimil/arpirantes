<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CalificacionModel;
use App\Models\AspiranteModel;

class Calificaciones extends Controller
{
    public function ver($curp)
    {
        $calificacionModel = new CalificacionModel();
        $aspiranteModel = new AspiranteModel();

        $aspirante = $aspiranteModel->where('curp', $curp)->first();
        $calificaciones = $calificacionModel->where('aspirante_curp', $curp)->first();

        // Si no hay calificaciones aún, inicializar en blanco
        if (!$calificaciones) {
            $calificaciones = [
                'parcial1' => null,
                'parcial2' => null,
                'parcial3' => null,
            ];
        }

        return view('base/publico/ver_calificaciones', [
            'aspirante' => $aspirante,
            'calificaciones' => $calificaciones,
        ]);

    }

    public function actualizar()
    {
        $request = \Config\Services::request();
        $calificacionModel = new CalificacionModel();

        $curp = $request->getPost('curp');
        $data = [
            'aspirante_curp' => $curp,
            'parcial1' => $request->getPost('parcial1'),
            'parcial2' => $request->getPost('parcial2'),
            'parcial3' => $request->getPost('parcial3'),
        ];

        // Verificar si ya existen calificaciones para este CURP
        $existe = $calificacionModel->where('aspirante_curp', $curp)->first();

        if ($existe) {
            $calificacionModel->where('aspirante_curp', $curp)->set($data)->update();
        } else {
            $calificacionModel->insert($data);
        }

        return redirect()->to(base_url('grupos')); // Redirige a grupos o donde prefieras
    }
}
