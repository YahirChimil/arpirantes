<?php


namespace App\Controllers;

require_once APPPATH . 'Libraries/dompdf/autoload.inc.php'; // Ajusta la ruta si lo pusiste en otro lado


use App\Models\GrupoModel;
use App\Models\AspiranteModel;
use App\Controllers\BaseController;
use CodeIgniter\Controller;
use Dompdf\Dompdf;


class Grupo extends Controller
{
    public function index()
    {
        $grupoModel = new \App\Models\GrupoModel();

        $convocatoriaSeleccionada = $this->request->getGet('convocatoria') ?? 'AGO25-DIC25'; // o la que uses


        $aspirantesSinGrupo = $this->obtenerAspirantesSinGrupoNivelacion($convocatoriaSeleccionada);

        $sedeModel = new \App\Models\SedesModel(); // Ajusta el nombre si tu modelo tiene otro
        $sedes = $sedeModel->findAll();



        $grupos = $grupoModel
            ->select('grupos.*, sedes.nombre_sede, carreras.nombre AS nombre_carrera, aulas.nombre AS nombre_aula')
            ->join('sedes', 'sedes.id_sede = grupos.sede')
            ->join('carreras', 'carreras.id = grupos.carrera')
            ->join('aulas', 'aulas.id = grupos.aula')
            ->findAll();




        $data = [
            'titulo'     => 'Documentación',
            'miga'       => 'Aspirante',
            'url_miga'   => base_url('aspirante/documentacion'),
            'sub_miga'   => 'documentacion',
            'user_info'  => datos_usuario(),
            'grupos' => $grupos,
            'sedes'  => $sedes,
            'aulas' => (new \App\Models\AulasModel())->findAll(),
            'aspirantesSinGrupoCurso' => $aspirantesSinGrupo,
            'convocatoriaSeleccionada' => $convocatoriaSeleccionada,

        ];

        return view('base/administrador/grupos_curso', $data);
    }


    public function obtenerAspirantesSinGrupoNivelacion($convocatoria)
    {
        $model = new \App\Models\AspiranteModel();

        return $model->select('aspirantes.sede AS sede_id, aspirantes.carrera AS carrera_id, sedes.nombre_sede, carreras.nombre AS nombre_carrera, COUNT(*) AS total')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede')
            ->join('carreras', 'carreras.id = aspirantes.carrera')
            ->where('aspirantes.grupo_nivelacion IS NULL')
            ->where('aspirantes.periodo', $convocatoria)
            ->where('aspirantes.preficha', 1)
            ->where('aspirantes.examen', 1)
            ->where('aspirantes.pago_curso', 1)

            ->groupBy('aspirantes.sede, aspirantes.carrera')
            ->findAll(); // <- Esto devuelve todos los grupos
    }



    public function crear()
    {
        $grupoModel = new \App\Models\GrupoModel();

        // Validación básica (puedes extenderla según sea necesario)
        $validationRules = [
            'nombre'        => 'required|min_length[3]',
            'capacidad'     => 'required|integer|min_length[1]',
            'hora_inicio'   => 'required',
            'hora_fin'      => 'required',
            'tipo'          => 'required',
            'sede_id'       => 'required|is_natural_no_zero',
            'aula_id'       => 'required|is_natural_no_zero',
            'carrera_id'    => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($validationRules)) {
            $errores = $this->validator->getErrors();

            // Unir todos los errores en un solo string
            $mensaje = "Datos inválidos: " . implode(' ', $errores);

            return redirect()->back()
                ->withInput()
                ->with('mensaje', $mensaje);
        }

        // Validar si la misma aula está ocupada en el mismo lapso de tiempo
        $aulaId = $this->request->getPost('aula_id');
        $horaInicio = $this->request->getPost('hora_inicio');
        $horaFin = $this->request->getPost('hora_fin');

        $grupoExistente = $grupoModel
            ->where('aula', $aulaId)
            ->where('hora_inicio <=', $horaFin)
            ->where('hora_fin >=', $horaInicio)
            ->first();

        if ($grupoExistente) {
            return redirect()->to(base_url('grupos/curso'))->with('error', 'La aula seleccionada ya está ocupada en el lapso de tiempo indicado.');
        }

        // Insertar datos
        $grupoModel->insert([
            'nombre'        => $this->request->getPost('nombre'),
            'capacidad'     => $this->request->getPost('capacidad'),
            'hora_inicio'   => $this->request->getPost('hora_inicio'),
            'hora_fin'      => $this->request->getPost('hora_fin'),
            'tipo'          => $this->request->getPost('tipo'),
            'catedratico'   => $this->request->getPost('catedratico'),
            'sede'          => $this->request->getPost('sede_id'),
            'aula'          => $this->request->getPost('aula_id'),
            'carrera'       => $this->request->getPost('carrera_id'),
        ]);

        return redirect()->to(base_url('grupos/curso'))->with('mensaje', 'Grupo creado correctamente.');
    }


    public function eliminarAspiranteCurso($grupo_id = null, $curp = null)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        if (!$curp || !$grupo_id) {
            return redirect()->back()->with('error', 'Datos incompletos.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();

        // Verificamos que el aspirante esté en ese grupo de curso
        $aspirante = $aspiranteModel->where('curp', $curp)
            ->where('grupo_nivelacion', $grupo_id)
            ->first();

        if (!$aspirante) {
            return redirect()->back()->with('error', 'Aspirante no encontrado o no pertenece a este grupo.');
        }

        // Actualizamos el grupo_nivelacion a null
        $aspiranteModel->update($aspirante['id'], ['grupo_nivelacion' => null]);

        return redirect()->to(base_url('grupos/verAspirantes/' . $grupo_id))
            ->with('success', 'Aspirante eliminado del grupo de curso.');
    }




    public function aspirantes($grupo_id)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $grupoModel = new \App\Models\GrupoModel();
        $aspiranteModel = new \App\Models\AspiranteModel();

        $grupo = $grupoModel->find($grupo_id);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        // Traer CURPs asignados
        $curpsAsignados = array_column(
            $aspiranteModel->select('curp')->where('grupo_nivelacion', $grupo_id)->findAll(),
            'curp'
        );

        // Aspirantes asignados (con info completa)
        $aspirantesAsignados = [];
        if (!empty($curpsAsignados)) {
            $aspirantesAsignados = $aspiranteModel
                ->select('aspirantes.*, carreras.nombre AS nombre_carrera, sedes.nombre_sede')
                ->join('carreras', 'carreras.id = aspirantes.carrera')
                ->join('sedes', 'sedes.id_sede = aspirantes.sede')
                ->whereIn('aspirantes.curp', $curpsAsignados)
                ->findAll();
        }

        $totalAsignados = count($aspirantesAsignados);
        $capacidad = (int) $grupo['capacidad'];
        $lugaresDisponibles = max(0, $capacidad - $totalAsignados);

        // Aspirantes disponibles (no asignados, con preficha y examen)
        $aspirantesDisponibles = [];
        if ($lugaresDisponibles > 0) {
            $aspirantesDisponibles = $aspiranteModel
                ->select('aspirantes.*, carreras.nombre AS nombre_carrera, sedes.nombre_sede')
                ->join('carreras', 'carreras.id = aspirantes.carrera')
                ->join('sedes', 'sedes.id_sede = aspirantes.sede')
                ->where('aspirantes.carrera', $grupo['carrera'])
                ->where('aspirantes.sede', $grupo['sede'])
                ->where('aspirantes.preficha', 1)
                ->where('aspirantes.examen', 1)
                ->where('aspirantes.grupo_nivelacion', null)
                ->limit($lugaresDisponibles)
                ->findAll();
        }

        // Unir ambos arrays para enviar a la vista
        $aspirantes = array_merge($aspirantesAsignados, $aspirantesDisponibles);

        return view('base/administrador/ver_aspirantes_grupo_niv', [
            'grupo' => $grupo,
            'aspirantes' => $aspirantes,
            'curpsAsignados' => $curpsAsignados,
            'totalAsignados' => $totalAsignados,
            'capacidad' => $capacidad,
            'lugaresDisponibles' => $lugaresDisponibles,
            'user_info' => datos_usuario(),
        ]);
    }


    public function asignarCurso($grupo_id)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $aspirantesSeleccionados = $this->request->getPost('aspirantes');

        if (!$aspirantesSeleccionados) {
            return redirect()->back()->with('error', 'No seleccionaste aspirantes.');
        }

        $db = \Config\Database::connect();
        $aspiranteModel = new \App\Models\AspiranteModel();

        foreach ($aspirantesSeleccionados as $aspirante_id) {
            // Asegúrate de que el aspirante existe
            $aspirante = $aspiranteModel->find($aspirante_id);

            if ($aspirante && is_null($aspirante['grupo_nivelacion'])) {
                // Asigna el grupo de curso solo si no tiene ya uno
                $aspiranteModel->update($aspirante_id, [
                    'grupo_nivelacion' => $grupo_id
                ]);
            }
        }

        return redirect()->to(base_url('grupos/verAspirantes/' . $grupo_id))
            ->with('success', 'Aspirantes asignados correctamente al grupo de curso.');
    }



    public function guardar_aprobados()
    {
        $aprobados = $this->request->getPost('aprobados'); // array de curps marcados
        $aspiranteModel = new \App\Models\AspiranteModel();

        // ✅ Primero: poner nivelacion_aprobado = 0 para todos
        $aspiranteModel->where('nivelacion_aprobado', 1)->set(['nivelacion_aprobado' => 0])->update();

        // ✅ Luego: si hay aspirantes marcados, poner nivelacion_aprobado = 1
        if (!empty($aprobados)) {
            foreach ($aprobados as $curp) {
                $aspiranteModel->where('curp', $curp)->set(['nivelacion_aprobado' => 1])->update();
            }
        }

        return redirect()->back()->with('mensaje', 'Aprobados actualizados correctamente.');
    }
    public function editar($id)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $grupoModel = new \App\Models\GrupoModel();
        $sedeModel = new \App\Models\SedesModel();
        $aulaModel = new \App\Models\AulasModel();
        $carreraModel = new \App\Models\CarrerasModel();

        $grupo = $grupoModel->find($id);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        $data = [
            'titulo' => 'Editar Grupo de Curso',
            'miga' => 'Administración',
            'url_miga' => base_url('grupos-curso'),
            'sub_miga' => 'editar_grupo',
            'user_info' => datos_usuario(),
            'grupo' => $grupo,
            'sedes' => $sedeModel->findAll(),
            'aulas' => $aulaModel->findAll(),
            'carreras' => $carreraModel->findAll(),
        ];

        return view('base/administrador/editar_grupo_curso', $data);
    }
    public function actualizar($id)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $grupoModel = new \App\Models\GrupoModel();

        $validationRules = [
            'nombre'        => 'required|min_length[3]',
            'capacidad'     => 'required|integer|min_length[1]',
            'hora_inicio'   => 'required',
            'hora_fin'      => 'required',
            'tipo'          => 'required',
            'sede_id'       => 'required|is_natural_no_zero',
            'aula_id'       => 'required|is_natural_no_zero',
            'carrera_id'    => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($validationRules)) {
            $errores = $this->validator->getErrors();
            $mensaje = "Datos inválidos: " . implode(' ', $errores);

            return redirect()->back()
                ->withInput()
                ->with('mensaje', $mensaje);
        }

        // Validar si la misma aula está ocupada en el mismo lapso de tiempo (excepto el grupo actual)
        $aulaId = $this->request->getPost('aula_id');
        $horaInicio = $this->request->getPost('hora_inicio');
        $horaFin = $this->request->getPost('hora_fin');


        $grupoExistente = $grupoModel
            ->where('aula', $aulaId)
            ->where('hora_inicio <=', $horaFin)
            ->where('hora_fin >=', $horaInicio)
            ->where('id !=', (int)$id)
            ->first();
        if ($grupoExistente) {
            return redirect()->back()->with('error', 'La aula seleccionada ya está ocupada en el lapso de tiempo indicado.');
        }

        $grupoModel->update($id, [
            'nombre'        => $this->request->getPost('nombre'),
            'capacidad'     => $this->request->getPost('capacidad'),
            'hora_inicio'   => $this->request->getPost('hora_inicio'),
            'hora_fin'      => $this->request->getPost('hora_fin'),
            'tipo'          => $this->request->getPost('tipo'),
            'catedratico'   => $this->request->getPost('catedratico'),
            'sede'          => $this->request->getPost('sede_id'),
            'aula'          => $this->request->getPost('aula_id'),
            'carrera'       => $this->request->getPost('carrera_id'),
        ]);

        return redirect()->to(base_url('grupos/curso'))->with('mensaje', 'Grupo actualizado correctamente.');
    }
    public function eliminar($grupo_id)
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $grupoModel = new \App\Models\GrupoModel(); // o GruposCursoModel si lo tienes separado
        $aspiranteModel = new \App\Models\AspiranteModel();

        // Verificar si el grupo existe
        $grupo = $grupoModel->find($grupo_id);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        // Actualizar a NULL el campo grupo_nivelacion en los aspirantes asignados a este grupo
        $aspiranteModel->where('grupo_nivelacion', $grupo_id)->set(['grupo_nivelacion' => null])->update();

        // Eliminar el grupo
        $grupoModel->delete($grupo_id);

        return redirect()->to(base_url('grupos/curso'))->with('mensaje', 'Grupo eliminado correctamente y aspirantes actualizados.');
    }


    public function exportarPDF($grupoId)
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $grupoModel = new \App\Models\GrupoModel();

        $grupo = $grupoModel->find($grupoId);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        $aspirantes = $aspiranteModel
            ->select('aspirantes.curp, aspirantes.nombre, aspirantes.primer_apellido, aspirantes.segundo_apellido, carreras.nombre AS nombre_carrera')
            ->join('carreras', 'aspirantes.carrera = carreras.id')
            ->where('grupo_nivelacion', $grupoId)

            ->findAll();

        // Generar HTML desde la vista
        $html = view('base/publico/pdf_aprobados', [
            'aspirantes' => $aspirantes,
            'grupo' => $grupo
        ]);

        // Configurar DOMPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();


        // Descargar el archivo
        $filename = 'Aspirantes_Aceptados_Grupo_' . $grupo['nombre'] . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]); // <- descarga forzada
        exit; // <- IMPORTANTE para evitar que siga ejecutando
    }

    public function toggleCurso()
    {
        $data = $this->request->getJSON(true);

        $curp = $data['curp'] ?? null;
        $estado = $data['nivelacion_aprobado'] ?? null;

        if (!$curp || !in_array($estado, [0, 1])) {
            return $this->response->setJSON(['success' => false, 'error' => 'Datos inválidos']);
        }

        $aspiranteModel = new \App\Models\AspiranteModel();

        $updated = $aspiranteModel->where('curp', $curp)->set('nivelacion_aprobado', $estado)->update();

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'No se pudo actualizar']);
    }

    // En Grupo.php
    public function aspirantesSinGrupoPorCarrera($sedeId, $carreraId)
    {
        $aspiranteModel = new \App\Models\AspiranteModel();

        $aspirantes = $aspiranteModel
            ->select('id, curp, nombre, primer_apellido, segundo_apellido')
            ->where('sede', $sedeId)
            ->where('carrera', $carreraId)
            ->where('grupo_nivelacion IS NULL')
            ->findAll();

        return $this->response->setJSON($aspirantes);
    }

    public function agregarManual($grupoId)
    {
        $curp = $this->request->getPost('curp');  // <-- Asegúrate que el formulario envía el curp

        if (!$curp) {
            return redirect()->back()->with('error', 'No se seleccionó ningún aspirante.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();
        $grupoModel = new \App\Models\GrupoModel();

        // Validar si el grupo existe
        $grupo = $grupoModel->find($grupoId);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        // Validar si el grupo está lleno
        $totalAsignados = $aspiranteModel->where('grupo_nivelacion', $grupoId)->countAllResults();
        $capacidad = (int) $grupo['capacidad'];

        if ($totalAsignados >= $capacidad) {
            return redirect()->back()->with('error', 'El grupo ya está lleno. No se pueden agregar más aspirantes.');
        }

        // Actualizar con where explícito por seguridad
        $actualizado = $aspiranteModel
            ->where('curp', $curp)
            ->set(['grupo_nivelacion' => $grupoId])
            ->update();

        if ($actualizado) {
            return redirect()->back()->with('success', 'Aspirante agregado manualmente al grupo.');
        }

        return redirect()->back()->with('error', 'No se pudo agregar el aspirante.');
    }




    public function getAspirantesSinGrupo()
    {
        $sedeId = $this->request->getPost('sede_id');
        $carreraId = $this->request->getPost('carrera_id');

        $db = \Config\Database::connect();

        $aspirantes = $db->table('aspirantes a')
            ->select('a.curp, a.nombre, a.primer_apellido, a.segundo_apellido')
            ->where('a.sede', $sedeId)
            ->where('a.carrera', $carreraId)
            ->where('a.preficha', 1)
            ->where('a.examen', 1)
            ->where('a.grupo_nivelacion IS NULL') // <- esta es la línea clave
            ->get()
            ->getResultArray();

        return $this->response->setJSON($aspirantes);
    }
}
