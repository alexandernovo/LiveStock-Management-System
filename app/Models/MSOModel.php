<?php

namespace App\Models;

use CodeIgniter\Model;

class MSOModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'MSO';
	protected $primaryKey           = 'MSO_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"DAStaff_id",
		"firstname",
		"lastname",
		"username",
		"password",
		"contact",
		"address",
		"status",
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $useSoftDeletes 		= false;
	protected $createdField         = 'registereddate';
	protected $updatedField         = false;
	protected $deletedField         = false;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
