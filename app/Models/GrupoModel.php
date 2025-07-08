<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    protected $table = 'grupos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'capacidad'];

    /*
    public function getGruposConAsignados()
    {
        return $this->select('grupos.*, COUNT(aspirantes.id) as asignados')
            ->join('aspirantes', 'aspirantes.grupo_nivelacion = grupos.nombre', 'left')
            ->groupBy('grupos.id')
            ->findAll();
    }
    */

    public function getGruposConAsignados()
    {
        return $this->select('grupos.*, COUNT(aspirantes.id) as asignados')
            ->join('aspirantes', 'aspirantes.grupo_nivelacion = grupos.id', 'left')
            ->groupBy('grupos.id')
            ->findAll();
    }


}


