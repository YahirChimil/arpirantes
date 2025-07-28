<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PreguntasModel;
use App\Models\RespuestasModel;
use CodeIgniter\Shield\Authentication\Authenticators\Session as Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class Encuesta extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (auth()->loggedIn()) {
            $user = auth()->user(); // Usuario autenticado

            $aspiranteModel = new \App\Models\AspiranteModel();
            $aspirante = $aspiranteModel->where('curp', $user->username)->first();

            if (!$aspirante) {
                return redirect()->to(site_url('Acceso/error'))->with('error', 'Aspirante no encontrado.');
            }

            // Verificar si ya inició la encuesta (existe algún registro en respuestas_encuesta con su CURP)
            $db = \Config\Database::connect();
            $builder = $db->table('respuestas_encuesta');
            $builder->where('aspirante_curp', $aspirante['curp']);
            $respuesta = $builder->get()->getRow();

            if ($respuesta) {

                return redirect()->to(site_url('Acceso/respondida'))->with('warning', 'Ya has respondido esta encuesta.');
            }


            // Obtener preguntas para mostrar el formulario
            $preguntaModel = new PreguntasModel();
            $preguntas = $preguntaModel->findAll();

            $data = [
                'titulo' => 'Principal',
                'miga' => 'Tableros',
                'url_miga' => base_url() . 'principal',
                'sub_miga' => 'inicio',
                'user_info' => datos_usuario(),
                'preguntas' => $preguntas,
                'aspirante' => $aspirante
            ];

            return view('base/publico/encuesta', $data);
        } else {
            return redirect()->to(site_url('Acceso/login'));
        }
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
    public function create()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'));
        }

        $user = auth()->user();
        $curp = $user->username; // CURP del aspirante, porque username = curp

        // Obtener respuestas del formulario
        $respuestas = $this->request->getPost('respuestas');

        if (!$respuestas || !is_array($respuestas)) {
            return redirect()->back()->with('error', 'No se recibieron respuestas válidas.');
        }

        $respuestasModel = new RespuestasModel();

        foreach ($respuestas as $pregunta_id => $respuesta) {
            $respuestasModel->save([
                'aspirante_curp' => $curp,
                'pregunta_id'    => $pregunta_id,
                'respuesta'      => is_array($respuesta) ? implode('|', $respuesta) : $respuesta
            ]);
        }

        return redirect()->to(base_url('Acceso/encuesta'))->with('success', '¡Gracias por responder la encuesta!');
    }





    public function generarPrefichas()
    {
        helper('date');
        $convocatoriaModel = new \App\Models\ConvocatoriaModel();
        $convocatoria = $convocatoriaModel->obtenerConvocatoriaActiva();

        if (!$convocatoria) {
            return redirect()->back()->with('error', 'No hay una convocatoria activa.');
        }

        $hoy = date('Y-m-d');
        if ($hoy <= $convocatoria['preficha_fin']) {
            return redirect()->back()->with('error', 'No puedes generar prefichas hasta que haya pasado la fecha de finalización de prefichas.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();
        $convocatoriaModel = new \App\Models\ConvocatoriaModel(); // Asegúrate de tener este modelo
        $db = \Config\Database::connect();

        $convocatoria = $convocatoriaModel->first(); // Puedes filtrar por la convocatoria activa si es necesario
        $fechaInicio = new \DateTime($convocatoria['preficha_inicio']);
        $periodo = $convocatoria['codigo'];

        $aspirantes = $aspiranteModel
            ->select('aspirantes.curp, aspirantes.carrera, aspirantes.sede, carreras.nombre as carrera_nombre, sedes.nombre_sede')
            ->join('carreras', 'carreras.id = aspirantes.carrera')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede')
            ->orderBy("(CASE WHEN aspirantes.sede = 1 THEN 0 ELSE 1 END)", 'ASC')
            ->orderBy('aspirantes.carrera', 'ASC')
            ->findAll();


        // Agrupar por sede y carrera
        $agrupados = [];
        foreach ($aspirantes as $a) {
            $key = $a['sede'] . '-' . $a['carrera'];
            $agrupados[$key][] = $a;
        }

        $fechaAsignada = clone $fechaInicio;
        $limiteDiario = 50;

        $builder = $db->table('fechas_preficha');
        $builder->truncate(); // Limpiar tabla (opcional, depende del caso)

        foreach ($agrupados as $grupo) {
            $total = count($grupo);
            $chunks = array_chunk($grupo, $limiteDiario);

            foreach ($chunks as $bloque) {
                foreach ($bloque as $aspirante) {
                    $builder->insert([
                        'curp' => $aspirante['curp'],
                        'carrera_id' => $aspirante['carrera'],
                        'sede_id' => $aspirante['sede'],
                        'fecha' => $fechaAsignada->format('Y-m-d'),
                        'periodo' => $periodo,
                    ]);
                }
                $fechaAsignada->modify('+1 day'); // Avanza un día solo si se usó un bloque
            }
        }

        return redirect()->back()->with('mensaje', 'Prefichas generadas exitosamente.');
    }



    public function obtenerPreficha()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'));
        }

        $user = auth()->user();
        $curp = $user->username;

        // Obtener datos del aspirante
        $aspiranteModel = new \App\Models\AspiranteModel();
        $aspirante = $aspiranteModel
            ->select('aspirantes.*, carreras.nombre as nombre_carrera, sedes.nombre_sede')
            ->join('carreras', 'carreras.id = aspirantes.carrera')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede')
            ->where('aspirantes.curp', $curp)
            ->first();

        if (!$aspirante) {
            return redirect()->back()->with('error', 'Aspirante no encontrado.');
        }

        // Obtener fecha de preficha
        $prefichaModel = new \App\Models\PrefichasModel();
        $preficha = $prefichaModel->where('curp', $curp)->first();


        if (!$preficha) {
            return redirect()->back()->with('error', 'No se ha asignado una fecha de entrega de documentos.');
        }
        // Ruta al logo (ajusta si está en /public/images/logos/)
        $logoPath = FCPATH . 'images/logos/logo_discere_svg_negro.svg';
        $logoBase64 = '';

        if (file_exists($logoPath)) {
            $imageData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/svg+xml;base64,' . base64_encode($imageData);
        }
        // Renderizar vista HTML
        $html = view('pdf/preficha', [
            'aspirante'      => $aspirante,
            'fecha_entrega'          => $preficha['fecha'],
            'periodo'        => $preficha['periodo'],
            'logoBase64'     => $logoBase64,
        ]);




        // Configurar Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar PDF
        $dompdf->stream('preficha_' . $aspirante['curp'] . '.pdf', ['Attachment' => true]);
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
    public function delete($id = null)
    {
        //
    }
}
