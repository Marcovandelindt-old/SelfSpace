<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrack extends Migration 
{
    public function up()
    {
        $this->forge->addField(
            [
                'trackId' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'spotifyId' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'systemName' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'image' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'discNumber' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => true,
                ],
                'durationMs' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'popularity' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => true,
                ],
            ]
        );
        
        $this->forge->addKey('trackId');
        $this->forge->createTable('tracks');
    }
    
    public function down()
    {
        $this->forge->dropTable('tracks');
    }
}