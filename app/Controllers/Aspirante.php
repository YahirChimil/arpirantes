<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Smalot\PdfParser\Parser;
use App\Models\AspiranteModel;
use CodeIgniter\Shield\Entities\User;
class Aspirante extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        
            return view('base/publico/aspirantes');

      
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
        'reingreso'        => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Por favor, completa todos los campos requeridos correctamente.');
    }

    // Datos del formulario
    $curp = $this->request->getPost('curp');
    $correo = $this->request->getPost('correo');

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
    ];

    // Guardar aspirante
    $aspiranteModel = new \App\Models\AspiranteModel();
    $aspiranteModel->save($data);

    // Generar contraseña aleatoria
    $password = bin2hex(random_bytes(4)); // 8 caracteres
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Crear usuario solo con username y password
    $users = auth()->getProvider();

    $user = new User([
    'username' => $curp,
    'email'    => $correo,
    'password' => $password, // sin hashear manualmente
    'nivel'    => 4
]);

    $users->save($user);

    // Enviar la contraseña al correo registrado
    $email = \Config\Services::email();
    $email->setTo($correo);
    $email->setSubject('Tu cuenta como aspirante');
    $email->setMessage(
        "Hola,\n\n".
        "Gracias por registrarte como aspirante.\n\n".
        "Tu nombre de usuario: $curp\n".
        "Tu contraseña: $password\n\n".
        "Por favor, guarda esta información de forma segura."
    );
    $email->send();

    return redirect()->to(base_url('Acceso/aspirante'))->with('success', 'Registro guardado. El usuario y contraseña han sido enviados al correo proporcionado.');
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

        return view('base/publico/editar_aspirante', $data);
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
            if (!$this->validate([
                'nombre'           => 'required',
                'primer_apellido'  => 'required',
                'correo'           => 'required|valid_email',
                // Agrega otras reglas según tu necesidad
            ])) {
                return redirect()->back()->withInput()->with('error', 'Verifica los campos del formulario.');
            }
    
            // Recoger datos
            $data = [
                'primer_apellido'     => $this->request->getPost('primer_apellido'),
                'segundo_apellido'    => $this->request->getPost('segundo_apellido'),
                'nombre'              => $this->request->getPost('nombre'),
                'correo'              => $this->request->getPost('correo'),
                'fecha_nacimiento'    => $this->request->getPost('fecha_nacimiento'),
                'edad'                => $this->request->getPost('edad'),
                'genero'              => $this->request->getPost('genero'),
                'telefono'            => $this->request->getPost('telefono'),
                'sede'                => $this->request->getPost('sede'),
                'carrera'             => $this->request->getPost('carrera'),
                'sede_alternativa'    => $this->request->getPost('sede_alternativa'),
                'carrera_alternativa' => $this->request->getPost('carrera_alternativa'),
                'reingreso'           => $this->request->getPost('reingreso'),
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
    if (auth()->loggedIn()) {
        $user = auth()->user(); // Obtener datos del usuario

        // Verificar si el nivel del usuario es 0 (admin) o 1 (developer)
        if (!in_array($user->nivel, [0, 1])) {
            return redirect()->to(site_url('Acceso/login'))->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        $aspiranteModel = new AspiranteModel();

        // Usar la función que ya devuelve los nombres de sede y carrera
        $data['aspirantes'] = $aspiranteModel->obtenerConRelaciones();

        // Datos para la vista
        $data['titulo'] = 'Principal';
        $data['miga'] = 'Tableros';
        $data['url_miga'] = base_url() . 'principal';
        $data['sub_miga'] = 'inicio';
        $data['user_info'] = datos_usuario();

        return view('base/publico/aspirantes_registrados', $data);
    } else {
        return redirect()->to(site_url('Acceso/login'));
    }
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

        // Dividir nombre completo
        $partes = explode(' ', $nombreCompleto);
        $primer_apellido = array_pop($partes); // Último
        $segundo_apellido = array_pop($partes); // Penúltimo
        $nombres = implode(' ', $partes); // El resto

        $fechaNacimiento = $this->obtenerFechaNacimientoDesdeCurp($curp);
        $edad = $this->calcularEdad($fechaNacimiento);
        $genero = $this->obtenerGeneroDesdeCurp($curp);

        return view('base/publico/aspirantes', [
            'curp'             => $curp,
            'fecha_nacimiento' => $fechaNacimiento,
            'edad'             => $edad,
            'genero'           => $genero,
            'nombre'           => $nombres,
            'primer_apellido'  => $segundo_apellido,
            'segundo_apellido' => $primer_apellido
        ]);
    }

    return redirect()->back()->with('error', 'Error al subir el archivo.');
}



}
