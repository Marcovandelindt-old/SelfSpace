<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTracksArtists extends Migration 
{
    /**
     * Add table
     */
    public function up()
    {
        $this->forge->addField(
            [
                'trackId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                ],
                'artistId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                ]
            ]
        );
        
        $this->forge->addKey('trackId');
        $this->forge->addKey('artistId');
        $this->forge->createTable('tracks_artists');
    }
    
    /**
     * Drop table
     */
    public function down()
    {
        $this->forge->dropTable('tracks_artists');
    }
}