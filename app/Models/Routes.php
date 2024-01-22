<?php

namespace App\Models;

use CodeIgniter\Model;

class Routes extends Model
{
    protected $table            = 'routes';
    protected $primaryKey       = 'route_id2';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['route', 'controller', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
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

    function updateRouteTable($data) {
        foreach ($data as $key => $row) {
            switch ($row->status) {
                case 0:
                    //žádné změny
                    break;

                case 1:
                    //nová routa
                    $table = array(
                        'route' => $row->route,
                        'controller' => $row->controller
                    );
                    $this->save($table);
                    break;

                case 2:
                    //změněná routa
                    $table = array(
                        'route' => $row->route,
                        'controller' => $row->controller,
                        'id' => $key
                    );
                    $this->save($table);
                    break;

                case 3:
                    $this->delete($key);
                    break;
                
                default:
                    break;

            }
        }
    }
}
