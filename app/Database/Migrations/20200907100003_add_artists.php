<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddArtist extends Migration 
{
    /**
     * Create table
     */
    public function up()
    {
        $this->forge->addField(
            [
                'artistId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type'       => 'varchar',
                    'constraint' => 255,
                ],
                'spotifyId' => [
                    'type'       => 'varchar',
                    'constraint' => 255,
                ],
                'image' => [
                    'type'       => 'varchar',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'popularity' => [
                    'type'       => 'int',
                    'constraint' => 11,
                    'null'       => true,
                ],
                'followers' => [
                    'type'       => 'int',
                    'constraint' => 11,
                    'null'       => true,
                ]
            ]
        );
        
        $this->forge->addKey('artistId');
        $this->forge->createTable('artists');
    }
    
    /**
     * Drop table
     */
    public function down()
    {
        $this->forge->dropTable('artists');
    }
}