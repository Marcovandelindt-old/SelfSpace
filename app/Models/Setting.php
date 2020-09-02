<?php

namespace App\Models;

use CodeIgniter\Model;

class Setting extends Model 
{
    protected $table      = 'settings';
    protected $primaryKey = 'settingId';
    
    protected $allowedFields = ['name', 'value'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created';
    protected $updatedField  = 'modified';
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    /**
     * Get a setting by name
     * 
     * @param string $name
     * 
     * @return mixed $result | false
     */
    public function getByName($name)
    {
        $database = \Config\Database::connect();
        $query    = $database->query('SELECT * FROM `settings` WHERE `name` = "' . $name . '"');
        
        $result = $query->getRow();
        
        if (!empty($result)) {
            return $result;
        }
        
        return false;
    }
}