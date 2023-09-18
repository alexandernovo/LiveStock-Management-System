<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentStatusModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'PaymentStatus';
	protected $primaryKey           = 'payment_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"inspectstatus_id",
		"Treasurer_id",
		"payment_status",
		"payment_price",
	];
	// Dates
	protected $useTimestamps        = true;
	protected $useSoftDeletes 		= false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = false;
	protected $updatedField         = 'payment_datetime ';
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
