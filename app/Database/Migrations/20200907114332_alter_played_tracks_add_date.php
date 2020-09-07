<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPlayedTracksAddDate extends Migration
{
    /**
     * Add column
     */
    public function up()
    {
        $fields = [
            'date' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ]
        ];
        
        $this->forge->addColumn('played_tracks', $fields);
    }
    
    /**
     * Drop column
     */
    public function down()
    {
        $this->forge->dropColumn('played_tracks', 'date');
    }
}