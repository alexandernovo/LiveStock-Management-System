<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\DAStaffModel;

class UserSeeder extends Seeder
{
	public function run()
	{
		$user_object = new DAStaffModel();

		$user_object->insertBatch([
			[
				'DAStaff_firstname' => 'Alexander',
				'DAStaff_lastname'  => 'Novo',
				'DAStaff_username'  => 'Admin',
				'DAStaff_password'  => password_hash('Admin', PASSWORD_DEFAULT)
			]
		]);
	}
}
/**
 * php spark db:seed UserSeeder
 */
