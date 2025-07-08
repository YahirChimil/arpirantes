<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Aulas extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
{
    if (auth()->loggedIn()) {
        $user = auth()->user();

        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $aulaModel = new \App\Models\AulasModel();
        $data['aulas'] = $aulaModel->findAll();
        $datos['sedes'] = (new \App\Models\SedesModel())->findAll();

        $data['titulo'] = 'Aulas y Laboratorios';
        $data['miga'] = 'Administración';
        $data['url_miga'] = base_url() . 'aulas';
        $data['sub_miga'] = 'aulas';
        $data['user_info'] = datos_usuario();

        return view('base/administrador/aulas', $data);
    }

    return redirect()->to(site_url('Acceso/login'));
}


    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function guardar()
{
    helper(['form']);

    $rules = [
        'nombre' => 'required',
        'capacidad' => 'required|numeric',
        'tipo' => 'required|in_list[1,2,3,4]',
        'sede_id' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->to(base_url('aulas'))
            ->withInput()
            ->with('error', 'Por favor completa correctamente todos los campos del aula.');
    }

    $aulaModel = new \App\Models\AulasModel();

    $data = [
        'nombre'    => $this->request->getPost('nombre'),
        'capacidad' => $this->request->getPost('capacidad'),
        'tipo'      => $this->request->getPost('tipo'),
        'sede_id'      => $this->request->getPost('sede_id'),
        'disponible'      => $this->request->getPost('disponible'),
        'observaciones'      => $this->request->getPost('observaciones'),


    ];

    try {
        $aulaModel->save($data);
    } catch (\Exception $e) {
        return redirect()->to(base_url('aulas/crear'))
            ->withInput()
            ->with('error', 'Error al guardar el aula.');
    }

    return redirect()->to(base_url('aulas/crear'))
        ->with('success', 'Aula registrada correctamente.');
}


    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
   public function editar($id)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
    }

    $aulaModel = new \App\Models\AulasModel();
    $aula = $aulaModel->find($id);

    if (!$aula) {
        return redirect()->to(base_url('aulas'))->with('error', 'Aula no encontrada.');
    }
      $datos['sedes'] = (new \App\Models\SedesModel())->findAll();

$data = [
    'titulo'    => 'Editar Aula',
    'aula'      => $aula,
    'miga'      => 'Administración',
    'url_miga'  => base_url() . 'aulas',
    'sub_miga'  => 'aulas',
    'user_info' => datos_usuario(),
];

// Unir los dos arreglos
return view('base/administrador/editar_aula', array_merge($data, $datos));

}


    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function actualizar($id)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para realizar esta acción.');
    }

    helper(['form']);

    $rules = [
        'nombre' => 'required',
        'sede_id' => 'required|integer',
      
        'tipo' => 'required|in_list[1,2,3,4]',
        
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Por favor revisa los campos del formulario.');
    }

    $aulaModel = new \App\Models\AulasModel();

    $aula = $aulaModel->find($id);
    if (!$aula) {
        return redirect()->to(base_url('aulas/crear'))->with('error', 'Aula no encontrada.');
    }

    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'sede_id' => $this->request->getPost('sede_id'),
        'capacidad' => $this->request->getPost('capacidad'),
        'tipo' => $this->request->getPost('tipo'),
        'disponible' => $this->request->getPost('disponible') ?? 0,
        'observaciones' => $this->request->getPost('observaciones'),
    ];

    $aulaModel->update($id, $data);

    return redirect()->to(base_url('aulas/crear'))->with('success', 'Aula actualizada correctamente.');
}

public function getAulasPorSede($sedeId)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return $this->response->setStatusCode(403)->setJSON(['error' => 'No autorizado']);
    }

    $aulaModel = new \App\Models\AulasModel();
    $aulas = $aulaModel->where('sede_id', $sedeId)->where('disponible', 1)->findAll();

    return $this->response->setJSON($aulas);
}

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
