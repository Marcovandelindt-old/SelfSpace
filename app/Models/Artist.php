<?php

namespace App\Models;

use CodeIgniter\Model;

class Artist extends Model 
{
    protected $table      = 'artists';
    protected $primaryKey = 'artistId';
    
    protected $allowedFields = ['name'];
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    /**
     * Check if an artist exists
     * 
     * @param string $spotifyId
     * 
     * @return bool true | false
     */
    public static function exists($spotifyId)
    {
         $database = \Config\Database::connect();
        $builder  = $database->table('artists');
        $query    = $builder->where('spotifyId', $spotifyId);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return true;
        }
        
        return false;
    }
    
     /**
     * Save an artist
     * 
     * @param array $data
     */
    public static function add($data)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('artists');
        $query    = $builder->insert($data);  
    }
}