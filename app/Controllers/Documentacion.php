<?php

namespace App\Controllers;

use App\Models\AspiranteModel;
use App\Models\DocumentosAspirantesModel;
use App\Models\DocumentosModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Documentacion extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        $curp = $user->username;

        // Obtener datos del aspirante
        $aspiranteModel = new \App\Models\AspiranteModel();
        $aspirante = $aspiranteModel->where('curp', $curp)->first();

        if (!$aspirante) {
            return redirect()->to(site_url('Acceso/error'))->with('error', 'Aspirante no encontrado.');
        }

        // Obtener documentos disponibles desde la base de datos
        $documentoModel = new \App\Models\DocumentosModel();
        $documentos = $documentoModel->where('activo', 1)->findAll();

        // Obtener documentos ya cargados por el aspirante
        $documentosAspiranteModel = new \App\Models\DocumentosAspirantesModel();
        $documentosSubidos = $documentosAspiranteModel
            ->where('aspirante_curp', $curp)
            ->findAll();

        // Organizar documentos subidos por documento_id
        $subidosMap = [];
        foreach ($documentosSubidos as $doc) {
            $subidosMap[$doc['documento_id']] = $doc;
        }
        $data = [
            'titulo'     => 'Documentación',
            'miga'       => 'Aspirante',
            'url_miga'   => base_url('aspirante/documentacion'),
            'sub_miga'   => 'documentacion',
            'user_info'  => datos_usuario(),
            'aspirante' => $aspirante,
            'documentos' => $documentos,
            'subidos' => $subidosMap,
            'miga' => 'Documentacion',
        ];

        return view('base/publico/documentacion_aspirante', $data);
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
    public function subir_documento()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        $curp = $user->username;

        $documentoId = $this->request->getPost('documento_id');
        $archivo = $this->request->getFile('archivo');

        if (!$documentoId || !$archivo || !$archivo->isValid()) {
            return redirect()->back()->with('error', 'Datos inválidos o archivo no válido.');
        }

        // Validar extensión PDF
        if ($archivo->getClientExtension() !== 'pdf') {
            return redirect()->back()->with('error', 'Solo se permiten archivos PDF.');
        }

        // Instancia del modelo
        $documentoAspiranteModel = new \App\Models\DocumentosAspirantesModel();

        // Buscar si ya hay un documento anterior
        $existente = $documentoAspiranteModel
            ->where('aspirante_curp', $curp)
            ->where('documento_id', $documentoId)
            ->first();

        // Carpeta de destino
        $ruta = WRITEPATH . '../public/uploads/';
        if (!is_dir($ruta)) {
            mkdir($ruta, 0755, true);
        }

        // Si ya existe un documento anterior, eliminarlo
        if ($existente && !empty($existente['ruta'])) {
            $archivoAnterior = $ruta . $existente['ruta'];
            if (file_exists($archivoAnterior)) {
                unlink($archivoAnterior);
            }
        }

        // Generar nombre único
        $nombreArchivo = $curp . '_' . $documentoId . '_' . time() . '.pdf';

        // Mover archivo
        if (!$archivo->move($ruta, $nombreArchivo)) {
            return redirect()->back()->with('error', 'Error al guardar el archivo.');
        }

        // Guardar en la base de datos
        if ($existente) {
            $documentoAspiranteModel->update($existente['id'], [
                'ruta' => $nombreArchivo,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $documentoAspiranteModel->insert([
                'aspirante_curp' => $curp,
                'documento_id' => $documentoId,
                'ruta' => $nombreArchivo,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->back()->with('success', 'Documento subido correctamente.');
    }



    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function eliminar_documento()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $documentoId = $this->request->getPost('documento_id');
        $curpUsuario = auth()->user()->username;

        if (!$documentoId) {
            return redirect()->back()->with('error', 'ID de documento no proporcionado.');
        }

        $model = new \App\Models\DocumentosAspirantesModel();

        // Buscar con where para ambas condiciones
        $documento = $model->where('aspirante_curp', $curpUsuario)
            ->where('documento_id', $documentoId)
            ->first();

        if (!$documento) {
            return redirect()->back()->with('error', 'Documento no encontrado.');
        }

        $archivoRuta = WRITEPATH . '../public/uploads/' . $documento['ruta'];
        if (is_file($archivoRuta)) {
            unlink($archivoRuta);
        }

        // Eliminar el registro por su id (primaria)
        $model->delete($documento['id']);

        return redirect()->back()->with('success', 'Documento eliminado correctamente.');
    }


    public function verDocumento($curp, $campo)
    {
        $ruta = WRITEPATH . 'documentos/' . $curp . '/' . $campo . '.pdf';

        if (!file_exists($ruta)) {
            return redirect()->back()->with('error', 'El documento no existe.');
        }

        // Devolver el PDF en línea (vista previa)
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $campo . '.pdf"')
            ->setBody(file_get_contents($ruta));
    }


    public function indexAdmin()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        // Filtros
        $sede = $this->request->getGet('sede');
        $carrera = $this->request->getGet('carrera');
        $paginaActual = (int)($this->request->getGet('page') ?? 1);
        $porPagina = 10;

        // Obtener CURPs de aspirantes con documentos subidos
        $documentosAspiranteModel = new \App\Models\DocumentosAspirantesModel();
        $curps = $documentosAspiranteModel
            ->select('aspirante_curp')
            ->distinct()
            ->findAll();
        $curpList = array_column($curps, 'aspirante_curp');

        // Construir consulta con filtros
        $aspiranteModel = new \App\Models\AspiranteModel();
        $builder = $aspiranteModel->whereIn('curp', $curpList);

        if ($sede) {
            $builder = $builder->where('sede', $sede);
        }
        if ($carrera) {
            $builder = $builder->where('carrera', $carrera);
        }

        // Contar total de aspirantes filtrados
        $totalAspirantes = $builder->countAllResults(false);

        // Obtener aspirantes paginados
        $aspirantes = $builder
            ->orderBy('nombre', 'asc')
            ->findAll($porPagina, $porPagina * ($paginaActual - 1));

        // Obtener sedes y carreras para los filtros
        $sedeModel = new \App\Models\SedesModel();
        $carreraModel = new \App\Models\CarrerasModel();
        $sedes = $sedeModel->findAll();
        $carreras = $carreraModel->findAll();

        $totalPaginas = ceil($totalAspirantes / $porPagina);

        $data = [
            'aspirantes'    => $aspirantes,
            'sedes'         => $sedes,
            'carreras'      => $carreras,
            'paginaActual'  => $paginaActual,
            'totalPaginas'  => $totalPaginas,
            'titulo'        => 'Documentación de Aspirantes',
            'miga'          => 'Administración',
            'url_miga'      => base_url() . 'admin/documentos',
            'sub_miga'      => 'documentos',
            'user_info'     => datos_usuario(),
        ];

        return view('base/administrador/documentos', $data);
    }

    public function indexCrearDocumento()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $documentosModel = new \App\Models\DocumentosModel();
        $documentos = $documentosModel->orderBy('id', 'desc')->findAll();


        $data = [


            'titulo'        => 'Crear Documento',
            'miga'          => 'Administración',
            'url_miga'      => base_url() . 'admin/crear_documentos',
            'sub_miga'      => 'documentos',
            'user_info'     => datos_usuario(),
            'documentos'    => $documentos,
        ];

        return view('base/administrador/crear_documento', $data);
    }


    public function crearDocumento()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        // Solo admin (nivel 0) o developer (nivel 1)
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nombre'      => 'required|max_length[100]',
            'descripcion' => 'required|max_length[255]',
            'obligatorio' => 'required|in_list[0,1]',
            'activo'      => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $validation->getErrors()));
        }

        $documentosModel = new \App\Models\DocumentosModel();
        $documentosModel->insert([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'obligatorio' => $this->request->getPost('obligatorio'),
            'activo'      => $this->request->getPost('activo'),
            'creado_en'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('admin/crear_documento'))->with('success', 'Documento creado correctamente.');
    }
    // Método para ver el documento (formulario de edición)
    public function verDoc($id)
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $documentosModel = new \App\Models\DocumentosModel();
        $documento = $documentosModel->find($id);

        if (!$documento) {
            return redirect()->to(site_url('admin/crear_documento'))->with('error', 'Documento no encontrado.');
        }


        $data = [


            'titulo'        => 'Editar Documento',
            'miga'          => 'Administración',
            'url_miga'      => base_url() . 'admin/editar_documentos',
            'sub_miga'      => 'documentos',
            'user_info'     => datos_usuario(),
            'documento' => $documento
        ];

        return view('base/administrador/editar_documento', $data);
    }

    // Método para actualizar el documento
    public function actualizarDocumento()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'id'          => 'required|is_natural_no_zero',
            'nombre'      => 'required|max_length[100]',
            'descripcion' => 'required|max_length[255]',
            'obligatorio' => 'required|in_list[0,1]',
            'activo'      => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $validation->getErrors()));
        }

        $documentosModel = new \App\Models\DocumentosModel();
        $id = $this->request->getPost('id');

        $documentosModel->update($id, [
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'obligatorio' => $this->request->getPost('obligatorio'),
            'activo'      => $this->request->getPost('activo'),
        ]);

        return redirect()->to(site_url('admin/crear_documento'))->with('success', 'Documento actualizado correctamente.');
    }

    public function ver($curp)
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Acceso no autorizado.');
        }

        // Obtener aspirante
        $aspiranteModel = new AspiranteModel();
        $aspirante = $aspiranteModel->where('curp', $curp)->first();

        if (!$aspirante) {
            return redirect()->back()->with('error', 'Aspirante no encontrado.');
        }

        // Obtener documentos disponibles
        $documentoModel = new DocumentosModel();
        $documentos = $documentoModel->where('activo', 1)->findAll();

        // Obtener documentos subidos por el aspirante
        $documentosAspiranteModel = new DocumentosAspirantesModel();
        $documentosSubidos = $documentosAspiranteModel->where('aspirante_curp', $curp)->findAll();

        $subidosMap = [];
        foreach ($documentosSubidos as $doc) {
            $subidosMap[$doc['documento_id']] = $doc;
        }

        return view('base/administrador/ver_documentacion_aspirante', [
            'titulo' => 'Revisión de Documentos',
            'miga' => 'Documentos',
            'url_miga' => base_url('admin/documentos'),
            'sub_miga' => 'Revisión',
            'user_info' => datos_usuario(),
            'aspirante' => $aspirante,
            'documentos' => $documentos,
            'subidos' => $subidosMap
        ]);
    }


    public function actualizar()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $id = $this->request->getPost('documento_aspirante_id');
        $estatus = $this->request->getPost('estatus');
        $observaciones = $this->request->getPost('observaciones');

        $model = new DocumentosAspirantesModel();
        $documento = $model->find($id);

        if (!$documento) {
            return redirect()->back()->with('error', 'Documento no encontrado.');
        }

        $model->update($id, [
            'estatus' => $estatus,
            'observaciones' => $observaciones,
        ]);

        return redirect()->back()->with('success', 'Documento actualizado correctamente.');
    }
}
