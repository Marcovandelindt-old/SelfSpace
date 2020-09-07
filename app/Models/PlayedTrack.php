<?php

namespace App\Models;

use CodeIgniter\Model;

class PlayedTrack extends Model 
{
    protected $table      = 'played_tracks';
    protected $primaryKey = 'playedTrackId';
    
    protected $allowedFields = ['trackId', 'playedAt'];
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    /**
     * Check if the played track already exists
     * 
     * @param string $timestamp
     * @param int $trackId
     * 
     * @return bool true | false
     */
    public static function exists($timestamp, $trackId)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('played_tracks');
        $builder->where(['playedAt' => $timestamp, 'trackId' => $trackId]);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Save a played track
     * 
     * @param array $data
     */
    public static function add($data)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('played_tracks');
        $query    = $builder->insert($data);  
    }
    
    /**
     * Get todays tracks
     * 
     * @return array
     * 
     * @return mixed $result | false
     */
    public static function getTodaysTracks()
    {
       $database = \Config\Database::connect();
       $builder  = $database->table('played_tracks');
       $builder->where('date', date('Y-m-d'));
       
       $result = $builder->get()->getResultArray();
       
       if (!empty($result)) {
           return $result;
       }
       
       return false;
    }
}