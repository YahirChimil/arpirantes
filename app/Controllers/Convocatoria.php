<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ConvocatoriaModel;


class Convocatoria extends BaseController
{
         // Mostrar formulario y convocatorias registradas
     // Mostrar el formulario y las convocatorias existentes
    public function index()
    {
        if (auth()->loggedIn()) {
            $user = auth()->user();

            if (!in_array($user->nivel, [0, 1])) {
                return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
            }

            $convocatoriaModel = new ConvocatoriaModel();
            $data['convocatorias'] = $convocatoriaModel->findAll();

            $data['titulo'] = 'Convocatorias';
            $data['miga'] = 'Administración';
            $data['url_miga'] = base_url() . 'convocatorias';
            $data['sub_miga'] = 'convocatorias';
            $data['user_info'] = datos_usuario();

            return view('base/administrador/crear_convocatoria', $data);
        }

        return redirect()->to(site_url('Acceso/login'));
    }

    // Guardar una nueva convocatoria
    public function guardar()
{
    helper(['form']);

    $rules = [
        'codigo'            => 'required',
        'registro_inicio'   => 'required|valid_date',
        'registro_fin'      => 'required|valid_date',
        'preficha_inicio'   => 'required|valid_date',
        'preficha_fin'      => 'required|valid_date',
        'documentos_inicio' => 'required|valid_date',
        'documentos_fin'    => 'required|valid_date',
        'examen_inicio'    => 'required|valid_date',
    ];

    if (!$this->validate($rules)) {
        return redirect()->to(base_url('convocatorias'))
            ->withInput()
            ->with('error', 'Por favor completa correctamente todos los campos de la convocatoria.');
    }

    $convocatoriaModel = new \App\Models\ConvocatoriaModel();

    $codigo = $this->request->getPost('codigo');

    // Verificar si ya existe una convocatoria con ese código
    if ($convocatoriaModel->where('codigo', $codigo)->first()) {
        return redirect()->to(base_url('convocatorias'))
            ->withInput()
            ->with('error', 'Ya existe una convocatoria con ese código.');
    }

    // Datos
    $data = [
        'codigo'            => $codigo,
        'registro_inicio'   => $this->request->getPost('registro_inicio'),
        'registro_fin'      => $this->request->getPost('registro_fin'),
        'preficha_inicio'   => $this->request->getPost('preficha_inicio'),
        'preficha_fin'      => $this->request->getPost('preficha_fin'),
        'documentos_inicio' => $this->request->getPost('documentos_inicio'),
        'documentos_fin'    => $this->request->getPost('documentos_fin'),
        'examen_inicio'   => $this->request->getPost('examen_inicio'),
    ];

    try {
        $convocatoriaModel->save($data);
    } catch (\Exception $e) {
        return redirect()->to(base_url('convocatoria/crear'))
            ->withInput()
            ->with('error', 'Error al guardar la convocatoria.');
    }

    return redirect()->to(base_url('convocatoria/crear'))
        ->with('success', 'Convocatoria registrada correctamente.');
}


public function getFechasConvocatoria($codigo)
{
    $convModel = new \App\Models\ConvocatoriaModel();
    $conv = $convModel->where('codigo', $codigo)->first();

    if ($conv) {
        $inicio = $conv['examen_inicio'];

        // Sumar 14 días (2 semanas)
        $fin = date('Y-m-d', strtotime($inicio . ' +14 days'));

        return $this->response->setJSON([
            'examen_inicio' => $inicio,
            'examen_fin'    => $fin,
        ]);
    }

    return $this->response->setJSON([
        'error' => 'Convocatoria no encontrada22'
    ])->setStatusCode(404);
}

}

