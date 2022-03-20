<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Table extends Migration
{
    public function up()
    {
        $this->forge->createDatabase('dtables_ss',true);
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 12,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 30,
                'null' => false
            ],
            'phone' => [
                'type' => 'varchar',
                'constraint' => 15,
                'null' => false
            ],
            'job' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => false
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('persons');
    }

    public function down()
    {
        $this->forge->dropTable('persons');
    }
}
