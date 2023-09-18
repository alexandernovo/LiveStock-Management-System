<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AjaxForms extends Migration
{
    public function up()
	{
		$this->forge->addField([
            'schedule_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'index_id' => [
				'type' => 'INT',
                'auto_increment' => true
            ],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Schedule');
	}

	public function down()
	{
		$this->forge->dropTable('Schedule');
	}
}
