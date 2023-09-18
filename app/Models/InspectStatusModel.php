<?php

namespace App\Models;

use CodeIgniter\Model;

class InspectStatusModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'InspectStatus';
	protected $primaryKey           = 'inspectstatus_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"Schedule_id",
		"Inspector_id",
		"inspect_status",
		"inspect_reason",
	];
	// Dates
	protected $useTimestamps        = true;
	protected $useSoftDeletes 		= false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = false;
	protected $updatedField         = 'inspect_datetime';
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
