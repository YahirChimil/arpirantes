<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AspiranteModel;

class Preficha extends BaseController
{



    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $fecha = $this->request->getGet('fecha');
        $aspirantes = [];

        if ($fecha) {
            $prefichasModel = new \App\Models\PrefichasModel();
            $aspiranteModel = new \App\Models\AspiranteModel();
            $sedeModel = new \App\Models\SedesModel();
            $carreraModel = new \App\Models\CarrerasModel();

            // Obtiene las prefichas para la fecha seleccionada
            $prefichas = $prefichasModel->where('fecha', $fecha)->findAll();

            foreach ($prefichas as $preficha) {
                $aspirante = $aspiranteModel->where('curp', $preficha['curp'])->first();
                if ($aspirante) {
                    $aspirante['sede_nombre'] = $sedeModel->where('id_sede', $preficha['sede_id'])->first()['nombre_sede'] ?? '';
                    $aspirante['carrera_nombre'] = $carreraModel->where('id', $preficha['carrera_id'])->first()['nombre'] ?? '';
                    $aspirante['preficha'] = 1;
                    $aspirantes[] = $aspirante;
                }
            }
        }


        $aspiranteModel = new \App\Models\AspiranteModel();

        // 1. Obtener todos los aspirantes de la convocatoria (ajusta el filtro si tienes campo de convocatoria)
        $aspirantesConvocatoria = $aspiranteModel->findAll();
        $totalAspirantesConvocatoria = count($aspirantesConvocatoria);

        // 2. Criterios para preficha (ajusta según tus reglas)
        $totalCriterioPreficha = 0;
        $totalNoCriterioPreficha = 0;

        foreach ($aspirantesConvocatoria as $aspirante) {
            // Ejemplo de criterios: pago realizado y encuesta contestada
            $pagoRealizado = isset($aspirante['preficha']) && $aspirante['preficha'] == 1;
            // Puedes agregar más criterios aquí

            if ($pagoRealizado) {
                $totalCriterioPreficha++;
            } else {
                $totalNoCriterioPreficha++;
            }
        }

        $data = [
            'titulo' => 'Prefichas por día',
            'miga' => 'Prefichas',
            'sub_miga' => 'Entrega Documentación',
            'fecha' => $fecha,
            'aspirantes' => $aspirantes,
            'user_info'     => datos_usuario(),
            // Totales para la vista
            'totalAspirantesConvocatoria' => $totalAspirantesConvocatoria,
            'totalCriterioPreficha' => $totalCriterioPreficha,
            'totalNoCriterioPreficha' => $totalNoCriterioPreficha,

        ];

        return view('base/publico/generacion_prefichas', $data);
    }


    public function descargarFicha($curp)
    {
        // Validación de acceso (puedes agregar roles si lo requieres)
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'));
        }

        // Obtener datos del aspirante por CURP
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

        // Ruta al logo
        $logoPath = FCPATH . 'images/logos/logo_discere_svg_negro.svg';
        $logoBase64 = '';

        if (file_exists($logoPath)) {
            $imageData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/svg+xml;base64,' . base64_encode($imageData);
        }

        $logo2Path = FCPATH . 'images/logos_discere/logo_cliente.png'; // Cambia el nombre y extensión según tu imagen
        $logo2Base64 = '';
        if (file_exists($logo2Path)) {
            $imageData2 = file_get_contents($logo2Path);
            $logo2Base64 = 'data:image/png;base64,' . base64_encode($imageData2);
        }

        // Renderizar vista HTML
        $html = view('pdf/preficha', [
            'aspirante'      => $aspirante,
            'fecha_entrega'  => $preficha['fecha'],
            'periodo'        => $preficha['periodo'],
            'logoBase64'     => $logoBase64,
            'logo2Base64'    => $logo2Base64,
            'logo3Base64'    => $logo3Base64 ?? '', // si usas logo3

        ]);

        // Configurar Dompdf
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar PDF
        $dompdf->stream('preficha_' . $aspirante['curp'] . '.pdf', ['Attachment' => true]);
    }
}
