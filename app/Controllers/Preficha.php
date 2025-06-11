<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AspiranteModel;

class Preficha extends BaseController
{
   
public function vistaEntregaDocumentacion()
{
    if (auth()->loggedIn()) {
        $user = auth()->user();

        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }
        $fechaLimite = '2025-07-15';
        $hoy = date('Y-m-d');
    
        if ($hoy > $fechaLimite) {
            return view('base/publico/no_habilitado', ['mensaje' => 'La asignación de fechas se habilitará después del ' . date('d/m/Y', strtotime($fechaLimite))]);
        }
    
        $aspiranteModel = new AspiranteModel();
    
        // Agrupar por sede y carrera
        $grupos = $aspiranteModel->select('sede, carrera, COUNT(*) as total')
            ->groupBy('sede, carrera')
            ->orderBy('sede')
            ->findAll();
    
        // Asignar día a cada grupo (1 grupo por día, empezando después de la fecha límite)
        $inicioEntrega = strtotime('2025-07-16');
        foreach ($grupos as $i => &$grupo) {
            $grupo['fecha_entrega'] = date('Y-m-d', strtotime("+$i day", $inicioEntrega));
        }

        
        

        // Datos adicionales para la vista
        $data['titulo'] = 'Principal';
        $data['miga'] = 'Tableros';
        $data['url_miga'] = base_url() . 'principal';
        $data['sub_miga'] = 'inicio';
        $data['user_info'] = datos_usuario();

        $data['grupos'] = $grupos;
return view('base/administrador/asignacion_preficha', $data);

        return redirect()->to(site_url('Acceso/login'));
    }
}




}


