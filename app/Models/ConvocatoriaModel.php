<?php

namespace App\Models;

use CodeIgniter\Model;

class ConvocatoriaModel extends Model
{
    protected $table            = 'convocatorias';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codigo','registro_inicio','registro_fin','preficha_inicio',
                                'preficha_fin','documentos_inicio','documentos_fin','examen_inicio'];

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

public function obtenerConvocatoriaActiva()
{
    $hoy = date('Y-m-d');
    return $this->where('registro_inicio <=', $hoy)
                ->where('registro_fin >=', $hoy)
                ->first();
}

    
}
