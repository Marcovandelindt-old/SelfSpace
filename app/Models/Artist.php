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
    
    /**
     * Get artist by spotifyId
     * 
     * @param string $spotifyId
     * 
     * @return mixed $result | false
     */
    public static function getBySpotifyId($spotifyId)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('artists');
        $query    = $builder->where('spotifyId', $spotifyId);
        
        $result = $builder->get()->getUnbufferedRow();
        
        if (!empty($result)) {
            return $result;
        }
        
        return false;
    }
    
    /**
     * Get the artists by trackId
     * 
     * @param int $trackId
     * 
     * @return array
     */
    public static function getByTrackId($trackId)
    {
        $database = \Config\Database::connect();
        $builder  = $database->table('tracks_artists');
        $query    = $builder->where('trackId', $trackId);
        
        $result = $query->get()->getResultArray();
        
        $artists = [];
        if (!empty($result)) {
            foreach ($result as $trackArtist) {
                $builder2 = $database->table('artists');
                $query2   = $builder2->where('artistId', $trackArtist['artistId']);
                $result2  = $query2->get()->getUnbufferedRow();
                
                if (!empty($result2)) {
                    $artists[] = $result2;
                }
            }
        }
        
        return $artists;
    }
}