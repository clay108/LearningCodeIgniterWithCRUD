<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        // Create the table fields
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'user_type' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user'], // Use array for ENUM values
                'default'    => 'user',             // Set default value to 'user'
                'null'       => false,
            ],
        ]);

        // Add primary key to the 'id' field
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('admin', true);  // 'true' ensures no error if the table already exists
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('admin', true);  // 'true' ensures no error if the table does not exist
    }
}
