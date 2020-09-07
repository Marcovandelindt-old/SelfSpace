<?php

namespace App\Models;

use CodeIgniter\Model;

class Track extends Model
{
    protected $table      = 'tracks';
    protected $primaryKey = 'trackId';
    
    protected $allowedFields = ['spotifyId', 'name', 'systemName', 'image', 'discNumber', 'durationMs', 'popularity'];
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    /**
     * Get a track by system name
     * 
     * @param string $systemName
     * 
     * @return mixed
     */
    public static function getBySystemName($systemName)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('tracks');
        $query    = $builder->where('systemName', $systemName);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return $result;
        }
        
        return false;
    }
    
    /**
     * Generate a system name for a track
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function generateSystemName($name)
    {
        if (!empty($name)) {
            $systemName = str_replace('(', '', $name);
            $systemName = str_replace(')', '', $systemName);
            $systemName = str_replace(' ', '_', $systemName);
            $systemName = str_replace('.', '', $systemName);
            $systemName = strtolower($systemName);
            
            return $systemName;
        }
    }
    
    /**
     * Check if a track exists
     * 
     * @param string $systemName
     * 
     * @return bool true | false
     */
    public static function exists($systemName)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('tracks');
        $query    = $builder->where('systemName', $systemName);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Save a track
     * 
     * @param array $data
     */
    public static function add($data)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('tracks');
        $query    = $builder->insert($data);  
    }
    
    /**
     * Get a track by id
     * 
     * @param int $id
     * 
     * @return mixed $result | false
     */
    public static function getById($id)
    {
        $database = \Config\Database::connect();
        $builder = $database->table('tracks');
        $builder->where('trackId', $id);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return $result;
        }
        
        return false;
    }
}