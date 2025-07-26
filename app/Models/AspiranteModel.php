<?php

namespace App\Models;

use CodeIgniter\Model;

class AspiranteModel extends Model
{
    protected $table = 'aspirantes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'periodo',
        'curp',
        'primer_apellido',
        'segundo_apellido',
        'nombre',
        'correo',
        'fecha_nacimiento',
        'edad',
        'genero',
        'telefono',
        'sede',
        'carrera',
        'sede_alternativa',
        'carrera_alternativa',
        'reingreso',
        'preficha',
        'periodo',
        'examen',
        'examen_aprobado',
        'pago_realizado',
        'grupo_nivelacion',
        'nivelacion_aprobado',
        'pago_curso',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function obtenerConRelaciones()
    {
        return $this->select('aspirantes.curp, aspirantes.nombre, aspirantes.primer_apellido, aspirantes.segundo_apellido, aspirantes.examen_aprobado, aspirantes.pago_realizado, aspirantes.grupo_nivelacion, sedes.nombre_sede as sede, carreras.nombre as carrera')
            ->join('sedes', 'sedes.id_sede = aspirantes.sede', 'left')
            ->join('carreras', 'carreras.id = aspirantes.carrera', 'left')
            ->findAll();
    }
    public function obtenerAspirantesPorGrupoConSede($grupo)
    {
        return $this->select('aspirantes.*, sedes.nombre as nombre_sede')
            ->join('sedes', 'sedes.id = aspirantes.sede', 'left')
            ->where('grupo_nivelacion', $grupo)
            ->findAll();
    }
}
