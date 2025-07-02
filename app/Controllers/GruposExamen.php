<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class GruposExamen extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
    }

    $convocatoriaSeleccionada = $this->request->getGet('convocatoria');
    $aspirantesSinGrupo = [];

    if ($convocatoriaSeleccionada) {
    $aspiranteModel = new \App\Models\AspiranteModel();
    $db = \Config\Database::connect();

    $aspirantesSinGrupo = $db->table('aspirantes')
        ->select('aspirantes.sede AS sede_id, aspirantes.carrera AS carrera_id, sedes.nombre_sede, carreras.nombre AS nombre_carrera, COUNT(*) AS total')
        ->join('sedes', 'sedes.id_sede = aspirantes.sede')
        ->join('carreras', 'carreras.id = aspirantes.carrera')
        ->join('aspirante_grupo_examen', 'aspirante_grupo_examen.curp = aspirantes.curp', 'left')
        ->where('aspirante_grupo_examen.grupo_id IS NULL') // Solo los que no tienen grupo asignado
        ->where('aspirantes.periodo', $convocatoriaSeleccionada)
        ->groupBy('aspirantes.sede, aspirantes.carrera')
        ->get()
        ->getResultArray();
}

$grupoModel = new \App\Models\GruposExamenModel();

$grupos = $grupoModel
    ->select('grupos_examen.*, sedes.nombre_sede, carreras.nombre as nombre_carrera, aulas.nombre as nombre_aula')
    ->join('sedes', 'sedes.id_sede = grupos_examen.sede_id')
    ->join('carreras', 'carreras.id = grupos_examen.carrera_id')
    ->join('aulas', 'aulas.id = grupos_examen.aula_id')
    ->orderBy('fecha', 'ASC')
    ->findAll();



    $data = [
        'titulo' => 'Grupos de Examen',
        'miga' => 'Administración',
        'url_miga' => base_url('grupos-examen'),
        'sub_miga' => 'grupos-examen',
        'user_info' => datos_usuario(),
        'grupos' => (new \App\Models\GruposExamenModel())->findAll(),
        'sedes' => (new \App\Models\SedesModel())->findAll(),
        'carreras' => (new \App\Models\CarrerasModel())->findAll(),
        'aulas' => (new \App\Models\AulasModel())->findAll(),
        'convocatorias' => (new \App\Models\ConvocatoriaModel())->findAll(),
        'aspirantesSinGrupo' => $aspirantesSinGrupo,
        'convocatoriaSeleccionada' => $convocatoriaSeleccionada,
        'grupos' =>$grupos,
    ];

    return view('base/administrador/grupos_examen', $data);
}

public function guardar()
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
    }

    helper(['form']);

    $rules = [
        'nombre'              => 'required',
        'codigo_convocatoria' => 'required',
        'sede_id'             => 'required|is_natural_no_zero',
        'carrera_id'          => 'required|is_natural_no_zero',
        'aula_id'             => 'required|is_natural_no_zero',
        'fecha'               => 'required|valid_date',
        'hora'                => 'required',
        'capacidad'           => 'required|numeric',
    ];

    if (!$this->validate($rules)) {
        return redirect()->to(base_url('grupos-examen'))
            ->withInput()
            ->with('error', 'Por favor completa correctamente todos los campos.');
    }

    $grupoModel = new \App\Models\GruposExamenModel();

    $data = [
        'nombre'              => $this->request->getPost('nombre'),
        'codigo_convocatoria' => $this->request->getPost('codigo_convocatoria'),
        'sede_id'             => $this->request->getPost('sede_id'),
        'carrera_id'          => $this->request->getPost('carrera_id'),
        'aula_id'             => $this->request->getPost('aula_id'),
        'fecha'               => $this->request->getPost('fecha'),
        'hora'                => $this->request->getPost('hora'),
        'capacidad'           => $this->request->getPost('capacidad'),
    ];

    try {
        $grupoModel->save($data);
        return redirect()->to(base_url('grupos-examen'))->with('success', 'Grupo creado correctamente.');
    } catch (\Exception $e) {
        return redirect()->to(base_url('grupos-examen'))->with('error', "Error al guardar el grupo: {$e->getMessage()}");

    }
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

    $grupoModel = new \App\Models\GruposExamenModel();
    $grupo = $grupoModel->find($id);

    if (!$grupo) {
        return redirect()->to(base_url('grupos-examen'))->with('error', 'Grupo no encontrado.');
    }

    $convocatoriaModel = new \App\Models\ConvocatoriaModel();
    $sedeModel         = new \App\Models\SedesModel();
    $carreraModel      = new \App\Models\CarrerasModel();
    $aulaModel         = new \App\Models\AulasModel();

    $data = [
        'titulo'     => 'Editar Grupo de Examen',
        'miga'       => 'Administración',
        'url_miga'   => base_url('grupos-examen'),
        'sub_miga'   => 'examenes',
        'user_info'  => datos_usuario(),

        'grupo'         => $grupo,
        'convocatorias' => $convocatoriaModel->findAll(),
        'sedes'         => $sedeModel->findAll(),
        'carreras'      => $carreraModel->findAll(),
        'aulas'         => $aulaModel->findAll(),
    ];

    return view('base/administrador/editar_grupo_examen', $data);
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
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
    }

    helper(['form']);

    $rules = [
        'nombre'               => 'required|string',
        'codigo_convocatoria' => 'required',
        'sede_id'             => 'required|numeric',
        'carrera_id'          => 'required|numeric',
        'aula_id'             => 'required|numeric',
        'fecha'               => 'required|valid_date',
        'hora'                => 'required',
        'capacidad'           => 'required|numeric|min_length[1]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Por favor, completa correctamente todos los campos.');
    }

    $grupoModel = new \App\Models\GruposExamenModel();

    $data = [
        'nombre'               => $this->request->getPost('nombre'),
        'codigo_convocatoria' => $this->request->getPost('codigo_convocatoria'),
        'sede_id'             => $this->request->getPost('sede_id'),
        'carrera_id'          => $this->request->getPost('carrera_id'),
        'aula_id'             => $this->request->getPost('aula_id'),
        'fecha'               => $this->request->getPost('fecha'),
        'hora'                => $this->request->getPost('hora'),
        'capacidad'           => $this->request->getPost('capacidad'),
    ];

    try {
        $grupoModel->update($id, $data);
        return redirect()->to(base_url('grupos-examen'))->with('success', 'Grupo actualizado correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Error al actualizar el grupo.');
    }
}


    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function aspirantes($grupo_id)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder.');
    }

    $grupoModel = new \App\Models\GruposExamenModel();
    $aspiranteModel = new \App\Models\AspiranteModel();
    $db = \Config\Database::connect();

    $grupo = $grupoModel->find($grupo_id);
    if (!$grupo) {
        return redirect()->back()->with('error', 'Grupo no encontrado.');
    }

    // Buscar aspirantes de la misma sede, carrera y con preficha pagada (preficha = 1)
    $aspirantes = $aspiranteModel
        ->select('aspirantes.*, carreras.nombre AS nombre_carrera, sedes.nombre_sede')
        ->join('carreras', 'carreras.id = aspirantes.carrera')
        ->join('sedes', 'sedes.id_sede = aspirantes.sede')
        ->where('aspirantes.carrera', $grupo['carrera_id'])
        ->where('aspirantes.sede', $grupo['sede_id'])
        ->where('aspirantes.preficha', 1) // ✅ SOLO PAGADOS
        ->findAll();

    // Obtener los CURP ya asignados a este grupo
    $asignados = $db->table('aspirante_grupo_examen')
        ->select('curp')
        ->where('grupo_id', $grupo_id)
        ->get()
        ->getResultArray();

    $curpsAsignados = array_column($asignados, 'curp');
    $totalAsignados = count($curpsAsignados);
    $capacidad = (int) $grupo['capacidad'];
    $lugaresDisponibles = max(0, $capacidad - $totalAsignados);

    $data = [
        'titulo'             => 'Aspirantes del Grupo',
        'grupo'              => $grupo,
        'miga'               => 'Administración',
        'aspirantes'         => $aspirantes,
        'curpsAsignados'     => $curpsAsignados,
        'totalAsignados'     => $totalAsignados,
        'capacidad'          => $capacidad,
        'lugaresDisponibles' => $lugaresDisponibles,
        'user_info'          => datos_usuario(),
    ];

    return view('base/administrador/ver_aspirantes_grupo', $data);
}


public function asignar($grupo_id)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
    }

    $aspirantesSeleccionados = $this->request->getPost('aspirantes');

    if (!$aspirantesSeleccionados) {
        return redirect()->back()->with('error', 'No seleccionaste aspirantes.');
    }

    $db = \Config\Database::connect();
    $builder = $db->table('aspirante_grupo_examen');

    foreach ($aspirantesSeleccionados as $aspirante_id) {
        // Obtener el CURP del aspirante
        $aspirante = $db->table('aspirantes')->select('curp')->where('id', $aspirante_id)->get()->getRow();

        if ($aspirante) {
            // Evitar duplicados
            $existe = $builder->where('curp', $aspirante->curp)->where('grupo_id', $grupo_id)->countAllResults();

            if ($existe == 0) {
                $builder->insert([
                    'curp' => $aspirante->curp,
                    'grupo_id' => $grupo_id,
                ]);
            }
        }
    }

    return redirect()->to(base_url('grupos-examen/aspirantes/' . $grupo_id))
        ->with('success', 'Aspirantes asignados correctamente al grupo.');
}

public function eliminarAspirante($grupo_id = null, $curp = null)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
    }

    if (!$curp || !$grupo_id) {
        return redirect()->back()->with('error', 'Datos incompletos.');
    }

    $db = \Config\Database::connect();
    $db->table('aspirante_grupo_examen')
        ->where('curp', $curp)
        ->where('grupo_id', $grupo_id)
        ->delete();

    return redirect()->to(base_url('grupos-examen/aspirantes/' . $grupo_id))
        ->with('success', 'Aspirante eliminado del grupo.');
}

public function imprimirLista($grupo_id)
{
    if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
        return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
    }

    $grupoModel = new \App\Models\GruposExamenModel();
    $aspiranteModel = new \App\Models\AspiranteModel();
    $db = \Config\Database::connect();

    $grupo = $grupoModel
        ->select('grupos_examen.*, carreras.nombre AS nombre_carrera, sedes.nombre_sede, aulas.nombre AS nombre_aula')
        ->join('carreras', 'carreras.id = grupos_examen.carrera_id')
        ->join('sedes', 'sedes.id_sede = grupos_examen.sede_id')
        ->join('aulas', 'aulas.id = grupos_examen.aula_id', 'left')
        ->find($grupo_id);

    $aspirantes = $db->table('aspirante_grupo_examen')
        ->select('aspirantes.curp, aspirantes.nombre, aspirantes.primer_apellido, aspirantes.segundo_apellido')
        ->join('aspirantes', 'aspirantes.curp = aspirante_grupo_examen.curp')
        ->where('aspirante_grupo_examen.grupo_id', $grupo_id)
        ->orderBy('aspirantes.primer_apellido')
        ->get()
        ->getResultArray();

    return view('base/administrador/imprimir_lista', [
        'grupo' => $grupo,
        'aspirantes' => $aspirantes,
    ]);
}





}
