<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPlayedTrack extends Migration 
{
    /**
     * Create the table for the played tracks
     */
    public function up()
    {        
        $this->forge->addField(
            [
                'playedTrackId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'trackId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                ],
                'playedAt' => [
                    'type' => 'timestamp',
                ],
            ]
        );
                
        $this->forge->addPrimaryKey('playedTrackId');
        $this->forge->addKey('trackId');
        $this->forge->createTable('played_tracks');
    }
    
    /**
     * Drop the table for the played tracks
     */
    public function down()
    {
        $this->forge->dropTable('played_tracks');
    }
}