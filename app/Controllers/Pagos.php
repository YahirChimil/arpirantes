<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pagos extends BaseController
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

        $sede     = $this->request->getGet('sede');
        $carrera  = $this->request->getGet('carrera');
        $preficha = $this->request->getGet('preficha');
        $pago     = $this->request->getGet('pago');
        $buscar   = $this->request->getGet('buscar');
        $porPagina = 10;
        $paginaActual = (int)($this->request->getGet('page') ?? 1);
        if ($paginaActual < 1) $paginaActual = 1;
        $offset = ($paginaActual - 1) * $porPagina;

        $aspirantes = [];
        $totalRegistros = 0;
        $totalPaginas = 1;

        // Solo buscar si hay algún filtro o búsqueda
        if ($sede || $carrera || $preficha !== '' || $pago !== '' || $buscar) {
            $aspiranteModel = new \App\Models\AspiranteModel();
            $query = $aspiranteModel
                ->select('aspirantes.*, sedes.nombre_sede as sede_nombre, carreras.nombre as carrera_nombre')
                ->join('sedes', 'sedes.id_sede = aspirantes.sede')
                ->join('carreras', 'carreras.id = aspirantes.carrera');

            if (!empty($sede) && $sede !== 'todas') {
                $query->where('sedes.id_sede', $sede);
            }
            if (!empty($carrera) && $carrera !== 'todas') {
                $query->where('carreras.id', $carrera);
            }
            if ($preficha === '1' || $preficha === '0') {
                $query->where('aspirantes.preficha', $preficha);
            }
            if (!empty($preficha) && $preficha !== 'todas' && $preficha !== '1' && $preficha !== '0') {
                // No filtrar por preficha si es "todas"
            }
            if ($pago === '1' || $pago === '0') {
                $query->where('aspirantes.pago_realizado', $pago);
            }
            if (!empty($pago) && $pago !== 'todas' && $pago !== '1' && $pago !== '0') {
                // No filtrar por pago si es "todas"
            }
            if (!empty($buscar)) {
                $query->groupStart()
                    ->like('aspirantes.curp', $buscar)
                    ->orLike('aspirantes.nombre', $buscar)
                    ->orLike('aspirantes.primer_apellido', $buscar)
                    ->orLike('aspirantes.segundo_apellido', $buscar)
                    ->groupEnd();
            }

            $totalRegistros = $query->countAllResults(false);
            $aspirantes = $query->limit($porPagina, $offset)->find();
            $totalPaginas = $totalRegistros > 0 ? ceil($totalRegistros / $porPagina) : 1;
        }

        // Para los filtros
        $sedeModel = new \App\Models\SedesModel();
        $carreraModel = new \App\Models\CarrerasModel();
        $sedes = $sedeModel->findAll();
        $carreras = $carreraModel->findAll();

        $data = [
            'aspirantes'    => $aspirantes,
            'sedes'         => $sedes,
            'carreras'      => $carreras,
            'filtro_sede'   => $sede,
            'filtro_carrera' => $carrera,
            'filtro_preficha' => $preficha,
            'filtro_pago'   => $pago,
            'buscar'        => $buscar,
            'paginaActual'  => $paginaActual,
            'totalPaginas'  => $totalPaginas,
            'totalRegistros' => $totalRegistros,
            'titulo'        => 'Pagos de Aspirantes',
            'miga'          => 'Administración',
            'sub_miga'      => 'Pagos',
            'user_info'     => datos_usuario(),
        ];

        return view('base/administrador/pagos_aspirantes', $data);
    }



    public function registrar_preficha()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $curp = $this->request->getPost('curp');
        $valor = $this->request->getPost('preficha') == '1' ? 1 : 0;

        $aspiranteModel = new \App\Models\AspiranteModel();
        $aspiranteModel->where('curp', $curp)->set(['preficha' => $valor])->update();

        return redirect()->back()->with('success', 'Pago de preficha actualizado.');
    }

    public function registrar_pago()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'Debes iniciar sesión.');
        }

        $curp = $this->request->getPost('curp');
        $valor = $this->request->getPost('pago_curso') == '1' ? 1 : 0;

        $aspiranteModel = new \App\Models\AspiranteModel();
        $aspiranteModel->where('curp', $curp)->set(['pago_curso' => $valor])->update();

        return redirect()->back()->with('success', 'Pago de curso actualizado.');
    }
    public function cargar_csv_preficha()
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $file = $this->request->getFile('csv_preficha');
        if ($file && $file->isValid() && $file->getExtension() === 'csv') {
            $handle = fopen($file->getTempName(), 'r');
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $row);
                if (!empty($data['CURP'])) {
                    // Solo cambia a 1, no importa el valor en el CSV
                    $aspiranteModel->where('curp', $data['CURP'])->set(['preficha' => 1])->update();
                }
            }
            fclose($handle);
            return redirect()->back()->with('success', 'Pagos de preficha registrados correctamente.');
        }
        return redirect()->back()->with('error', 'Archivo inválido.');
    }

    public function cargar_csv_curso()
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $file = $this->request->getFile('csv_curso');
        if ($file && $file->isValid() && $file->getExtension() === 'csv') {
            $handle = fopen($file->getTempName(), 'r');
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $row);
                if (!empty($data['CURP'])) {
                    // Solo cambia a 1, no importa el valor en el CSV
                    $aspiranteModel->where('curp', $data['CURP'])->set(['pago_curso' => 1])->update();
                }
            }
            fclose($handle);
            return redirect()->back()->with('success', 'Pagos de curso registrados correctamente.');
        }
        return redirect()->back()->with('error', 'Archivo inválido.');
    }
}
