<?php


namespace App\Controllers;

require_once APPPATH . 'Libraries/dompdf/autoload.inc.php'; // Ajusta la ruta si lo pusiste en otro lado


use App\Models\GrupoModel;
use App\Models\AspiranteModel;
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

        $grupos = $grupoModel->findAll();

        foreach ($grupos as &$grupo) {
            $aspiranteModelTemp = new \App\Models\AspiranteModel();
            $grupo['asignados'] = $aspiranteModelTemp
                ->where('grupo_nivelacion', $grupo['nombre'])
                ->countAllResults();
        }

            $data=[
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


    public function obtenerAspirantesSinGrupoNivelacion($convocatoriaSeleccionada)
{
    $aspiranteModel = new \App\Models\AspiranteModel();
   

    $builder = $aspiranteModel->builder();

    $aspirantesSinGrupo = $builder
    ->select('aspirantes.sede AS sede_id, aspirantes.carrera AS carrera_id, sedes.nombre_sede, carreras.nombre AS nombre_carrera, COUNT(*) AS total')
    ->join('sedes', 'sedes.id_sede = aspirantes.sede')
    ->join('carreras', 'carreras.id = aspirantes.carrera')
    ->join('aspirante_grupo_examen', 'aspirante_grupo_examen.curp = aspirantes.curp', 'left')
    ->where('aspirantes.grupo_nivelacion IS NULL', null, false) // condición IS NULL sin escapar
    ->where('aspirantes.periodo', $convocatoriaSeleccionada)
    ->where('aspirantes.preficha', 1)
    ->where('aspirantes.examen', 1)
    ->groupBy('aspirantes.sede, aspirantes.carrera')
    ->get()
    ->getResultArray();

return $aspirantesSinGrupo;

}

    
    public function crear()
    {
        $grupoModel = new GrupoModel();
        $grupoModel->insert([
            'nombre' => $this->request->getPost('nombre_grupo'),
            'capacidad' => $this->request->getPost('capacidad')
        ]);
        return redirect()->back()->with('mensaje', 'Grupo creado.');
    }

    public function eliminar($id)
    {
        $grupoModel = new GrupoModel();
        $grupoModel->delete($id);
        return redirect()->back()->with('mensaje', 'Grupo eliminado.');
    }

    

    public function verAspirantes($grupoId)
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $grupoModel = new \App\Models\GrupoModel();

        $grupo = $grupoModel->find($grupoId);
        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        $aspirantes = $aspiranteModel
            ->select('aspirantes.curp, aspirantes.nombre, aspirantes.primer_apellido, aspirantes.segundo_apellido, aspirantes.examen, sedes.nombre_sede as nombre_sede, carreras.nombre AS nombre_carrera, nivelacion_aprobado')
            ->join('sedes', 'aspirantes.sede = sedes.id_sede')
            ->join('carreras', 'aspirantes.carrera = carreras.id')
            ->where('grupo_nivelacion', $grupo['id'])
            ->findAll();

        return view('base/publico/aspirantes_por_grupo', [
            'aspirantes' => $aspirantes,
            'grupo' => ['id' => $grupo['id'], 'nombre' => $grupo['nombre']]
        ]);
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
            ->where('nivelacion_aprobado', 1)
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
}






