<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Smalot\PdfParser\Parser;
use App\Models\AspiranteModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;

class Aspirante extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function index()
    {
        $convocatoriaModel = new \App\Models\ConvocatoriaModel();
        $convocatoria = $convocatoriaModel->obtenerConvocatoriaActiva();

        // Si no hay convocatoria activa, buscar la próxima convocatoria
        if (!$convocatoria) {
            $proxima = $convocatoriaModel
                ->where('registro_inicio >', date('Y-m-d'))
                ->orderBy('registro_inicio', 'ASC')
                ->first();

            return view('base/publico/sin_convocatoria', [
                'periodo' => $proxima['codigo'] ?? '',
                'registro_inicio' => $proxima['registro_inicio'] ?? '',
                'registro_fin' => $proxima['registro_fin'] ?? '',
            ]);
        }

        return view('base/publico/aspirantes', [
            'convocatoria' => $convocatoria,
            'periodo'      => $convocatoria['codigo'] ?? null,
        ]);
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
        helper(['form', 'text']);



        $rules = [
            'primer_apellido' => 'required',
            'segundo_apellido' => 'required',
            'nombre'           => 'required',
            'correo'           => 'required|valid_email',
            'fecha_nacimiento' => 'required|valid_date',
            'edad'             => 'required|numeric',
            'genero'           => 'required',
            'telefono'         => 'required',
            'sede'             => 'required',
            'carrera'          => 'required',
            'reingreso'        => 'required',
            'periodo'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->withInput()
                ->with('error', 'Por favor, completa todos los campos requeridos correctamente.');
        }

        $curp = $this->request->getPost('curp');
        $correo = $this->request->getPost('correo');

        $aspiranteModel = new AspiranteModel();

        // Verificar si el CURP ya está registrado
        if ($aspiranteModel->where('curp', $curp)->first()) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->withInput()
                ->with('error', 'El CURP ya está registrado.')
                ->with('curp_analizado', $curp);
        }

        // Verificar si el correo ya está registrado en auth_identities
        $userIdentityModel = new UserIdentityModel();

        $correoExiste = $userIdentityModel
            ->where('type', 'email_password')
            ->where('secret', $correo)
            ->first();

        if ($correoExiste) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->withInput()
                ->with('error', 'El correo ya está registrado en el sistema. No se pudo crear el usuario.');
        }


        // Guardar aspirante primero
        $data = [
            'curp'                => $curp,
            'primer_apellido'     => $this->request->getPost('primer_apellido'),
            'segundo_apellido'    => $this->request->getPost('segundo_apellido'),
            'nombre'              => $this->request->getPost('nombre'),
            'correo'              => $correo,
            'fecha_nacimiento'    => $this->request->getPost('fecha_nacimiento'),
            'edad'                => $this->request->getPost('edad'),
            'genero'              => $this->request->getPost('genero'),
            'telefono'            => $this->request->getPost('telefono'),
            'sede'                => $this->request->getPost('sede'),
            'carrera'             => $this->request->getPost('carrera'),
            'sede_alternativa'    => $this->request->getPost('sede_alternativa'),
            'carrera_alternativa' => $this->request->getPost('carrera_alternativa'),
            'reingreso'           => $this->request->getPost('reingreso'),
            'periodo'           => $this->request->getPost('periodo'),


        ];

        try {
            $aspiranteModel->save($data);
        } catch (\Exception $e) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->withInput()
                ->with('error', 'Ocurrió un error al guardar el aspirante.');
        }

        // Crear usuario Shield correctamente con el service de auth
        $password = bin2hex(random_bytes(4)); // contraseña aleatoria 8 caracteres


        $userModel = new UserModel();


        // ...antes de crear el usuario Shield...
        $nombre = $this->request->getPost('nombre');
        $primer_apellido = $this->request->getPost('primer_apellido');
        $segundo_apellido = $this->request->getPost('segundo_apellido');

        $user = new User([
            'username' => $curp,
            'email'    => $correo,
            'password' => $password,
            'nivel'    => 4,
            'foto'     => 'default.png',
            'nombre'   => $nombre . ' ' . $primer_apellido . ' ' . $segundo_apellido // Nombre completo
        ]);

        if (! $userModel->save($user)) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->with('error', 'No se pudo crear el usuario.');
        }





        // Enviar correo con credenciales
        $emailService = \Config\Services::email();
        $emailService->setTo($correo);
        $emailService->setSubject('Tu cuenta como aspirante');
        $emailService->setMessage(
            '
            <div style="font-family: Inter, Arial, sans-serif; background: #f7f7f7; padding: 32px;">
                <div style="max-width: 500px; margin: auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px #0001; padding: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <img src="' . base_url('images/logos/logo_discere_svg_negro.svg') . '" alt="Logo TecNM" style="height: 30px;">
                        <h2 style="color: #1a202c; font-weight: 700; margin: 0; flex: 1; text-align: center;"></h2>
                        <img src="' . base_url('images/logos/logo_ito.png') . '" alt="Logo ITO" style="height: 60px;">
                    </div>
                    <p style="font-size: 1.1em; color: #222; margin-bottom: 18px;">
                        <strong>¡Gracias por registrarte como aspirante!</strong>
                    </p>
                    <div style="background: #f1f5f9; border-radius: 8px; padding: 18px; margin-bottom: 18px;">
                        <p style="margin: 0 0 8px 0; color: #333;">Tus credenciales de acceso:</p>
                        <p style="margin: 0; font-size: 1.05em;">
                            <b>Usuario (CURP):</b> <span style="color: #2563eb;">' . esc($curp) . '</span><br>
                            <b>Contraseña:</b> <span style="color: #2563eb;">' . esc($password) . '</span>
                        </p>
                    </div>
                    <p style="color: #222; margin-bottom: 18px;">
                        Por favor, guarda esta información de forma segura.<br>
                        Ingresa a la plataforma <b>Discere</b> en el apartado de <b>Aspirantes</b> y <b>Encuesta</b> para contestar la encuesta correspondiente.
                    </p>
                    <p style="color: #222; margin-bottom: 18px;">
                        Si tienes alguna duda, visita nuestro sitio oficial:<br>
                        <a href="https://www.itoaxaca.edu.mx" style="color: #2563eb; text-decoration: underline;" target="_blank">www.itoaxaca.edu.mx</a>
                        <br>o contáctanos por correo.
                    </p>
                    <div style="text-align: center; margin-top: 32px;">
                        <p style="color: #888; font-size: 0.95em; margin-top: 8px;">Saludos cordiales,<br>Instituto Tecnológico de Oaxaca</p>
                    </div>
                </div>
            </div>
            '
        );
        $emailService->setMailType('html');

        if (! $emailService->send()) {
            return redirect()->to(base_url('Acceso/aspirante'))
                ->with('error', 'No se pudo enviar el correo electrónico.');
        }

        return redirect()->to(base_url('Acceso/aspirante'))
            ->with('success', 'Registro guardado. El usuario y contraseña han sido enviados al correo proporcionado.');
    }

    public function obtenerAvanceAspirante($curp)
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $userModel = new \CodeIgniter\Shield\Models\UserModel();
        $respuestasModel = new \App\Models\RespuestasModel();
        $prefichasModel = new \App\Models\PrefichasModel();
        $documentosModel = new \App\Models\DocumentosModel();
        $documentosAspiranteModel = new \App\Models\DocumentosAspirantesModel();

        // Paso 1: Registro
        $aspirante = $aspiranteModel->where('curp', $curp)->first();
        $registro = $aspirante ? true : false;

        // Paso 2: Usuario creado en sistema
        $usuario = $userModel->where('username', $curp)->first();
        $usuarioCreado = $usuario ? true : false;

        // Paso 3: Encuesta contestada
        $respuestas = $respuestasModel->where('aspirante_curp', $curp)->countAllResults();
        $encuestaContestada = $respuestas > 0;

        // Paso 4: Pago realizado (campo preficha en tabla aspirantes, 1=pagado, 0=no pagado)
        $pagoRealizado = ($aspirante && isset($aspirante['preficha']) && $aspirante['preficha'] == 1);

        // Paso 5: Preficha generada por el instituto
        $preficha = $prefichasModel->where('curp', $curp)->first();
        $prefichaGenerada = $preficha ? true : false;

        // Documentos necesarios
        $documentosNecesarios = $documentosModel->where('activo', 1)->countAllResults();

        // Paso extra: Documentación subida (todos los documentos subidos, sin importar estatus)
        $documentosSubidos = $documentosAspiranteModel
            ->where('aspirante_curp', $curp)
            ->where('ruta IS NOT NULL', null, false)
            ->countAllResults();
        $documentacionSubida = ($documentosSubidos == $documentosNecesarios && $documentosNecesarios > 0);

        // Paso extra: Documentación aprobada (todos los documentos con estatus 2)
        $documentosAprobados = $documentosAspiranteModel
            ->where('aspirante_curp', $curp)
            ->where('estatus', 2)
            ->countAllResults();
        $documentacionAprobada = ($documentosAprobados == $documentosNecesarios && $documentosNecesarios > 0);

        // Calcular avance
        $totalPasos = 7;
        $pasosCompletados = ($registro ? 1 : 0)
            + ($usuarioCreado ? 1 : 0)
            + ($encuestaContestada ? 1 : 0)
            + ($pagoRealizado ? 1 : 0)
            + ($prefichaGenerada ? 1 : 0)
            + ($documentacionSubida ? 1 : 0) // Nuevo paso: documentación subida
            + ($documentacionAprobada ? 1 : 0); // Documentación aprobada

        $porcentaje = intval(($pasosCompletados / $totalPasos) * 100);

        return [
            'registro' => $registro,
            'usuarioCreado' => $usuarioCreado,
            'encuestaContestada' => $encuestaContestada,
            'pagoRealizado' => $pagoRealizado,
            'prefichaGenerada' => $prefichaGenerada,
            'documentacionSubida' => $documentacionSubida, // Nuevo campo
            'documentacionAprobada' => $documentacionAprobada,
            'porcentaje' => $porcentaje,
            'preficha' => $preficha
        ];
    }




    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($curp = null)
    {
        if (auth()->loggedIn()) {
            $usuario = datos_usuario(); // Suponiendo que retorna un array con info del usuario

            // Validar que solo entren developers o administradores
            if (!in_array($usuario['nivel'], [0, 1])) {
                return redirect()->to(site_url('aspirante'))->with('error', 'No tienes permiso para editar aspirantes.');
            }

            $aspiranteModel = new AspiranteModel();

            // Obtener los datos del aspirante por su CURP
            $aspirante = $aspiranteModel->where('curp', $curp)->first();

            if (!$aspirante) {
                return redirect()->to(site_url('aspirante'))->with('error', 'Aspirante no encontrado.');
            }

            $data['aspirante'] = $aspirante;

            // Información general para la vista
            $data['titulo'] = 'Editar aspirante';
            $data['miga'] = 'Aspirantes';
            $data['url_miga'] = base_url('aspirante');
            $data['sub_miga'] = 'Editar';
            $data['user_info'] = $usuario;

            return view('base/administrador/editar_aspirante', $data);
        } else {
            return redirect()->to(site_url('Acceso/login'));
        }
    }


    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($curp = null)
    {
        if (auth()->loggedIn()) {
            $aspiranteModel = new AspiranteModel();

            // Validación rápida
            if (
                !$this->validate([
                    'nombre' => 'required',
                    'primer_apellido' => 'required',
                    'correo' => 'required|valid_email',
                    // Agrega otras reglas según tu necesidad
                ])
            ) {
                return redirect()->back()->withInput()->with('error', 'Verifica los campos del formulario.');
            }

            // Recoger datos
            $data = [
                'primer_apellido' => $this->request->getPost('primer_apellido'),
                'segundo_apellido' => $this->request->getPost('segundo_apellido'),
                'nombre' => $this->request->getPost('nombre'),
                'correo' => $this->request->getPost('correo'),
                'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                'edad' => $this->request->getPost('edad'),
                'genero' => $this->request->getPost('genero'),
                'telefono' => $this->request->getPost('telefono'),
                'sede' => $this->request->getPost('sede'),
                'carrera' => $this->request->getPost('carrera'),
                'sede_alternativa' => $this->request->getPost('sede_alternativa'),
                'carrera_alternativa' => $this->request->getPost('carrera_alternativa'),
                'reingreso' => $this->request->getPost('reingreso'),
                //Datos NUEVOS

            ];



            // Actualizar
            $aspiranteModel->where('curp', $curp)->set($data)->update();

            return redirect()->to(site_url('Acceso/aspirante_registrados'))->with('success', 'Aspirante actualizado correctamente.');
        } else {
            return redirect()->to(site_url('Acceso/login'));
        }
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



    public function indexAS()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(site_url('Acceso/login'));
        }

        $user = auth()->user();
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $sede = $this->request->getGet('sede');
        $carrera = $this->request->getGet('carrera');
        $preficha = $this->request->getGet('preficha');
        $buscar = $this->request->getGet('buscar');

        $porPagina = 10; // registros por página
        $paginaActual = (int) ($this->request->getGet('page') ?? 1);
        if ($paginaActual < 1) $paginaActual = 1;
        $offset = ($paginaActual - 1) * $porPagina;

        $aspiranteModel = new AspiranteModel();

        // Consulta base
        $query = $aspiranteModel->select('aspirantes.*, sedes.nombre_sede as sede, carreras.nombre as carrera')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede')
            ->join('carreras', 'carreras.id = aspirantes.carrera');

        // Filtros
        if (!empty($sede)) {
            $query->where('sedes.id_sede', $sede);
        }

        if (!empty($carrera)) {
            $query->where('carreras.id', $carrera);
        }

        if ($preficha === '1' || $preficha === '0') {
            $query->where('aspirantes.preficha', $preficha);
        }

        if (!empty($buscar)) {
            $query->groupStart()
                ->like('aspirantes.curp', $buscar)
                ->orLike('aspirantes.nombre', $buscar)
                ->orLike('aspirantes.primer_apellido', $buscar)
                ->orLike('aspirantes.segundo_apellido', $buscar)
                ->groupEnd();
        }

        // Obtener total para paginación
        $totalRegistros = $query->countAllResults(false); // false para no resetear el builder

        // Obtener datos de la página actual con límite y offset
        $aspirantes = $query->limit($porPagina, $offset)->find();

        $totalPaginas = ceil($totalRegistros / $porPagina);

        $data = [
            'aspirantes' => $aspirantes,
            'filtro_sede' => $sede,
            'filtro_carrera' => $carrera,
            'filtro_preficha' => $preficha,
            'buscar' => $buscar,
            'paginaActual' => $paginaActual,
            'totalPaginas' => $totalPaginas,
            'titulo' => 'Principal',
            'miga' => 'Tableros',
            'url_miga' => base_url() . 'principal',
            'sub_miga' => 'inicio',
            'user_info' => datos_usuario(),
        ];

        return view('base/administrador/aspirantes_registrados', $data);
    }







    private function obtenerFechaNacimientoDesdeCurp($curp)
    {
        $anio = substr($curp, 4, 2);
        $mes = substr($curp, 6, 2);
        $dia = substr($curp, 8, 2);
        $siglo = (intval($anio) >= 0 && intval($anio) <= intval(date('y'))) ? '20' : '19';
        return "$siglo$anio-$mes-$dia";
    }

    private function calcularEdad($fechaNacimiento)
    {
        $nacimiento = new \DateTime($fechaNacimiento);
        $hoy = new \DateTime();
        return $hoy->diff($nacimiento)->y;
    }

    private function obtenerGeneroDesdeCurp($curp)
    {
        $genero = substr($curp, 10, 1);
        return $genero === 'H' ? 'Masculino' : 'Femenino';
    }
    public function analizar_curp()
    {
        helper(['form', 'url']);
        $file = $this->request->getFile('curp');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            // Leer PDF
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();
            $lineas = explode("\n", $text);

            // Buscar CURP y nombre en líneas consecutivas
            $curp = '';
            $nombreCompleto = '';
            foreach ($lineas as $i => $linea) {
                if (preg_match('/[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d/', $linea, $matches)) {
                    $curp = substr($matches[0], 0, 18);
                    $nombreCompleto = isset($lineas[$i + 1]) ? trim($lineas[$i + 1]) : '';
                    break;
                }
            }

            // Validar si no se encontró ningún CURP
            if (empty($curp)) {
                return redirect()->back()->with('error', 'No se encontró ningún CURP en el archivo proporcionado.');
            }

            // Validar si el CURP ya existe en la base de datos
            $aspiranteModel = new \App\Models\AspiranteModel();
            if ($aspiranteModel->where('curp', $curp)->first()) {
                return redirect()->back()->with('error', 'El CURP ya está registrado en el sistema.');
            }

            // Dividir nombre completo
            $partes = explode(' ', $nombreCompleto);
            $primer_apellido = array_pop($partes); // Último
            $segundo_apellido = array_pop($partes); // Penúltimo
            $nombres = implode(' ', $partes); // El resto

            $fechaNacimiento = $this->obtenerFechaNacimientoDesdeCurp($curp);
            $edad = $this->calcularEdad($fechaNacimiento);
            $genero = $this->obtenerGeneroDesdeCurp($curp);

            $convocatoriaModel = new \App\Models\ConvocatoriaModel();
            $convocatoria = $convocatoriaModel->obtenerConvocatoriaActiva();

            return view('base/publico/aspirantes', [
                'curp'             => $curp,
                'fecha_nacimiento' => $fechaNacimiento,
                'edad'             => $edad,
                'genero'           => $genero,
                'nombre'           => $nombres,
                'primer_apellido'  => $segundo_apellido,
                'segundo_apellido' => $primer_apellido,
                'periodo'          => $convocatoria['codigo'] ?? null,
            ]);
        }

        return redirect()->back()->with('error', 'Error al subir el archivo.');
    }


    public function generarFalsosAspirantes($cantidad = 10)
    {
        helper('text');
        $aspiranteModel = new AspiranteModel();
        $userModel = new UserModel();
        $faker = \Faker\Factory::create('es_MX');

        $sedes = [1, 2];
        $carreras = [22, 35, 36, 37, 38, 39, 40, 41, 42, 43];
        $reingresos = ['Sí', 'No'];
        $generos = ['M', 'F'];
        $periodo = 'AGO25-DIC25';

        for ($i = 0; $i < $cantidad; $i++) {
            $curp = strtoupper(random_string('alnum', 18));
            $correo = "aspirante{$i}_" . time() . "@example.com";
            $password = bin2hex(random_bytes(4)); // 8 caracteres

            $aspiranteModel->save([
                'periodo'             => $periodo,
                'curp'                => $curp,
                'primer_apellido'     => $faker->lastName,
                'segundo_apellido'    => $faker->lastName,
                'nombre'              => $faker->firstName,
                'correo'              => $correo,
                'fecha_nacimiento'    => $faker->date('Y-m-d', '2005-01-01'),
                'edad'                => $faker->numberBetween(17, 25),
                'genero'              => $faker->randomElement($generos),
                'telefono'            => $faker->numerify('951#######'),
                'sede'                => $faker->randomElement($sedes),
                'carrera'             => $faker->randomElement($carreras),
                'sede_alternativa'    => null,
                'carrera_alternativa' => null,
                'reingreso'           => $faker->randomElement($reingresos),
                'preficha'            => $faker->randomElement([0, 1]),
            ]);

            $user = new \CodeIgniter\Shield\Entities\User([
                'username' => $curp,
                'email'    => $correo,
                'password' => $password,
            ]);
            $userModel->save($user);

            $user = $userModel->findById($userModel->getInsertID());

            $userModel->save($user);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => "Se generaron $cantidad aspirantes aleatorios correctamente."]);
    }

    public function toggleExamen()
    {
        $json = $this->request->getJSON();

        if (!$json || !isset($json->curp) || !isset($json->examen)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Datos inválidos']);
        }

        $aspiranteModel = new \App\Models\AspiranteModel();
        $actualizado = $aspiranteModel
            ->where('curp', $json->curp)
            ->set('examen', (int)$json->examen)
            ->update();

        return $this->response->setJSON(['success' => $actualizado]);
    }
    public function cargarCSVExamen()
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $file = $this->request->getFile('csv_file');

        if (!$file->isValid() || $file->getClientExtension() !== 'csv') {
            return redirect()->back()->with('error', 'Archivo inválido. Asegúrate de subir un archivo .csv.');
        }

        $handle = fopen($file->getTempName(), 'r');
        if (!$handle) {
            return redirect()->back()->with('error', 'No se pudo leer el archivo CSV.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();
        $actualizados = 0;
        $noEncontrados = [];

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $curp = trim($row[0] ?? '');

            if ($curp !== '') {
                $aspirante = $aspiranteModel->where('curp', $curp)->first();
                if ($aspirante) {
                    $updated = $aspiranteModel->where('curp', $curp)->set(['examen' => 1])->update();
                    if ($updated) {
                        $actualizados++;
                    }
                } else {
                    $noEncontrados[] = $curp;
                }
            }
        }

        fclose($handle);

        $mensaje = "Se actualizaron $actualizados aspirantes desde el CSV.";
        if (!empty($noEncontrados)) {
            $mensaje .= " No encontrados: " . implode(', ', $noEncontrados);
        }

        return redirect()->back()->with('success', $mensaje);
    }


    public function imprimirSeleccionados()
    {
        if (!auth()->loggedIn() || !in_array(auth()->user()->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No autorizado.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();

        $aspirantes = $aspiranteModel
            ->select('aspirantes.curp, sedes.nombre_sede, carreras.nombre AS nombre_carrera')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede')
            ->join('carreras', 'carreras.id = aspirantes.carrera')
            ->where('aspirantes.examen', 1)
            ->findAll();

        // Logo TecNM en base64
        $logoPath = FCPATH . 'images/logos/logo_discere_svg_negro.svg';
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $imageData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($imageData);
        }

        // Renderizar vista HTML para PDF
        $html = view('pdf/aspirantes_seleccionados', [
            'aspirantes' => $aspirantes,
            'logoBase64' => $logoBase64,
        ]);

        // Generar PDF con Dompdf
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar PDF
        $dompdf->stream('aspirantes_seleccionados.pdf', ['Attachment' => true]);
    }



    public function actualizarEstado($id)
    {
        $model = new \App\Models\AspiranteModel();
        $data = [
            'examen_aprobado' => $this->request->getPost('examen_aprobado') ? 1 : 0,
            'pago_realizado' => $this->request->getPost('pago_realizado') ? 1 : 0
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('aspirantes'));
    }

    //METODO AGREGADO
    public function asignarGrupo($curp)
    {
        $aspiranteModel = new \App\Models\AspiranteModel();
        $aspirante = $aspiranteModel->where('curp', $curp)->first();

        if ($aspirante) {
            $aspiranteModel->where('curp', $curp)->set(['grupo_nivelacion' => 'Grupo A'])->update();
            return redirect()->to(base_url('Acceso/aspirante_registrados'))->with('mensaje', 'Grupo asignado.');
        } else {
            return redirect()->back()->with('mensaje', 'Aspirante no encontrado.');
        }
    }


    //METODO NUEVO NUEVO 
    public function asignarGrupoVista($curp)
    {
        $grupoModel = new \App\Models\GrupoModel();
        $aspiranteModel = new \App\Models\AspiranteModel();

        $grupos = $grupoModel->findAll();

        foreach ($grupos as &$grupo) {
            $grupo['asignados'] = $aspiranteModel->where('grupo_nivelacion', $grupo['id'])->countAllResults();
        }

        return view('base/publico/asignar_grupo', [
            'grupos' => $grupos,
            'curp' => $curp //
        ]);
    }


    public function asignarAGrupo()
    {
        $curp = $this->request->getPost('curp');
        $grupo_id = $this->request->getPost('grupo_id');

        $aspiranteModel = new \App\Models\AspiranteModel();
        $grupoModel = new \App\Models\GrupoModel();

        // Verificar capacidad
        $grupo = $grupoModel->find($grupo_id);
        $asignados = $aspiranteModel->where('grupo_nivelacion', $grupo_id)->countAllResults();

        if ($asignados >= $grupo['capacidad']) {
            return redirect()->back()->with('error', 'Este grupo ya está lleno.');
        }

        // Asignar grupo
        $aspiranteModel->where('curp', $curp)->set(['grupo_nivelacion' => $grupo_id])->update();

        return redirect()->to('aspirante_registrados')->with('success', 'Aspirante asignado correctamente.');
    }

    /*
        public function asignarAGrupoFinal()
        {
            $curp = $this->request->getPost('curp');
            $grupoNombre = $this->request->getPost('grupo_nombre');

            if (!$curp || !$grupoNombre) {
                return redirect()->back()->with('error', 'Faltan datos para la asignación.');
            }

            $aspiranteModel = new \App\Models\AspiranteModel();

            // Actualiza el campo grupo_nivelacion con el nombre del grupo
            $aspiranteModel
                ->where('curp', $curp)
                ->set('grupo_nivelacion', $grupoNombre)
                ->update();

            return redirect()->to(base_url('aspirante/asignarGrupoVista/' . $curp))
                ->with('mensaje', 'Aspirante asignado correctamente.');
        }
    */

    public function asignarAGrupoFinal()
    {
        $curp = $this->request->getPost('curp');
        $grupoId = $this->request->getPost('grupo_id'); // <- ahora usamos el ID

        if (!$curp || !$grupoId) {
            return redirect()->back()->with('error', 'Faltan datos para la asignación.');
        }

        $aspiranteModel = new \App\Models\AspiranteModel();

        $aspiranteModel
            ->where('curp', $curp)
            ->set('grupo_nivelacion', $grupoId)
            ->update();

        return redirect()->to(base_url('aspirante/asignarGrupoVista/' . $curp))
            ->with('mensaje', 'Aspirante asignado correctamente.');
    }


    public function indexExamen()
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
        $examen = $this->request->getGet('examen');

        $buscar   = $this->request->getGet('buscar');
        $porPagina = 25;
        $paginaActual = (int)($this->request->getGet('page') ?? 1);
        if ($paginaActual < 1) $paginaActual = 1;
        $offset = ($paginaActual - 1) * $porPagina;

        $aspirantes = [];
        $totalRegistros = 0;
        $totalPaginas = 1;

        // Solo buscar si hay algún filtro o búsqueda
        if ($sede || $carrera || $examen !== '' || $buscar) {
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
            if ($examen === '1' || $examen === '0') {
                $query->where('aspirantes.preficha', $examen);
            }
            if (!empty($preficha) && $preficha !== 'todas' && $preficha !== '1' && $preficha !== '0') {
                // No filtrar por preficha si es "todas"
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
            'filtro_examen' => $examen,
            'buscar'        => $buscar,
            'paginaActual'  => $paginaActual,
            'totalPaginas'  => $totalPaginas,
            'totalRegistros' => $totalRegistros,
            'titulo'        => 'Pagos de Aspirantes',
            'miga'          => 'Administración',
            'sub_miga'      => 'Seleccionados',
            'user_info'     => datos_usuario(),
        ];

        return view('base/administrador/Aspirantes_seleccionados', $data);
    }
}
