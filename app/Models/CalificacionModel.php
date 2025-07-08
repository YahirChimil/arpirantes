<?php

namespace App\Models;
use CodeIgniter\Model;

class CalificacionModel extends Model
{
    protected $table = 'calificaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['aspirante_curp', 'parcial1', 'parcial2', 'parcial3'];
    protected $returnType = 'array';
}
