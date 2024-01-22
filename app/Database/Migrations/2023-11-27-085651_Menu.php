<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {

        $this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => '8',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'link' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'name' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'rank' => [
				'type'       => 'INT',
				'constraint' => '8',
			],
            'type' => [
				'type'       => 'TINYINT',
				'constraint' => '8',
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'deleted_at DATETIME DEFAULT NULL'
		]);
		$this->forge->addKey('id', true);
        $this->forge->addKey('rank');
        $this->forge->addKey('type');
		$this->forge->createTable('menu');
        
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
