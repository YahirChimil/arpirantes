<?php

namespace App\Models;

use CodeIgniter\Model;

class CarrerasModel extends Model
{
    protected $table            = 'carreras';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
         'version', 'usuario', 'deleted', 'uuid', 'clave',
        'clave_oficial', 'reticula', 'nombre', 'nombre_corto', 'nivel', 'modalidad',
        'estatus', 'plantel', 'fecha_inicio', 'fecha_fin', 'tipo', 'prefijo', 'observaciones'
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Obtiene las carreras por sede con estatus 'V'.
     * 
     * @param int $sedeId
     * @return array
     */
    public function obtenerPorSede($sedeId)
    {
        return $this->select('carreras.id, carreras.nombre')
            ->join('carreras_sedes', 'carreras_sedes.carrera_id = carreras.id')
            ->where('carreras_sedes.sede_id', $sedeId)
            ->where('carreras.estatus', 'V')
            ->findAll();
    }

    

}
