<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PreguntasModel;
use App\Models\RespuestasModel;
use CodeIgniter\Shield\Authentication\Authenticators\Session as Auth;

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
