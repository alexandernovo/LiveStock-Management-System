<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use \DateTime;


class QueryModel
{
	protected $db;
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		date_default_timezone_set('Asia/Manila');
	}
	// Transaction History Admin
	function viewTransaction($date_from, $date_to, $filter)
	{
		return $this->db->table('Schedule')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->groupBy('Schedule.index_id')
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->whereIn('Schedule.schedule_status', $filter)
			->get()
			->getResult();
	}
	function viewTransactionGroup()
	{
		return $this->db->table('Schedule')
			->groupBy('DATE(schedule_datetime)')
			->get()
			->getResult();
	}

	public function getScheduleDatetime()
	{
		return $this->db->table('Schedule')->select('schedule_datetime')->groupBy('index_id')->get()->getResultArray();
	}

	// Graph per month inspect Status
	public function getScheduleCountByMonth()
	{
		// Fetch all schedules
		$schedules = $this->db->table('InspectStatus')
			->where('inspect_status', 'Accepted')
			->orderBy('inspect_datetime', 'ASC')
			->get()
			->getResult();
		$schedule_count = array();
		foreach ($schedules as $schedule) {
			// Extract the month and year from the date using DateTime
			$date = new DateTime($schedule->inspect_datetime);
			$month_year = $date->format('M Y');
			if (isset($schedule_count[$month_year])) {
				$schedule_count[$month_year]++;
			} else {
				$schedule_count[$month_year] = 1;
			}
		}
		return json_encode($schedule_count);
	}

	public function getScheduleCountByMonths()
	{
		$schedules = $this->db->table('Schedule')
			->orderBy('Schedule_datetime', 'ASC')
			->groupBy('index_id')
			->get()
			->getResult();
		$schedule_counts = array();
		foreach ($schedules as $schedule) {
			// Extract the month and year from the date using DateTime
			$date = new DateTime($schedule->schedule_datetime);
			$month_year = $date->format('M Y');
			if (isset($schedule_counts[$month_year])) {
				$schedule_counts[$month_year]++;
			} else {
				$schedule_counts[$month_year] = 1;
			}
		}
		return json_encode($schedule_counts);
	}

	function viewTransactionDetails($index_id, $filter)
	{
		return $this->db->table('Schedule')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->join('InspectStatus', 'InspectStatus.schedule_id = Schedule.schedule_id')
			->where('Schedule.index_id', $index_id)
			->whereIn('InspectStatus.inspect_status', $filter)
			->orderBy('Schedule.schedule_id', 'DESC')
			->get()
			->getResult();
	}
	// View History in MSO
	function viewhistoryMSO($mso_id, $filter, $date_from, $date_to)
	{
		return $this->db->table('Schedule')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->groupBy('Schedule.index_id')
			->orderBy('Schedule.schedule_id', 'DESC')
			->where('MSO.MSO_id', $mso_id)
			->whereIn('Schedule.schedule_status', $filter)
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->get()
			->getResult();
	}

	// View History Details in MSO
	function msohistorydetails($id, $index_id, $filter)
	{
		return $this->db->table('InspectStatus')
			->select('Schedule.Animal_type,Schedule.schedule_id,InspectStatus.inspectstatus_id, Schedule.Animal_weight,Schedule.Animal_origin,Schedule.Animal_quantity,Schedule.index_id,InspectStatus.inspect_status,InspectStatus.inspect_reason, InspectStatus.Inspector_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->where('MSO.MSO_id', $id)
			->where('Schedule.index_id', $index_id)
			->whereIn('InspectStatus.inspect_status', $filter)
			->get()
			->getResult();
	}
	function count($index_id)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('Schedule.index_id', $index_id)
			->where('InspectStatus.inspect_status', 'Pending')
			->countAllResults();
	}
	function msohistorypayment($id, $index_id)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->where('MSO.MSO_id', $id)
			->where('Schedule.index_id', $index_id)
			->get()
			->getResult();
	}
	// schedules
	function inspectorviewsched()
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->groupBy('Schedule.index_id')
			->orderBy('Schedule.schedule_id', 'DESC')
			->where('InspectStatus.inspect_status', 'Pending')
			->get()
			->getResult();
	}
	function inspectorviewscheddetails($index_id, $filter)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->orderBy('Schedule.schedule_id', 'DESC')
			->where('Schedule.index_id', $index_id)
			->whereIn('InspectStatus.inspect_status', $filter)
			->get()
			->getResult();
	}
	function inspectorperDate($filter, $date_from, $date_to)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->orderBy('Schedule.schedule_id', 'DESC')
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->whereIn('Schedule.schedule_status', $filter)
			->groupBy('Schedule.index_id')
			->get()
			->getResult();
	}
	function treasurerviewsched()
	{
		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->groupBy('Schedule.index_id')
			->orderBy('PaymentStatus.payment_id', 'ASC')
			->where('InspectStatus.inspect_status', 'Accepted')
			->groupBy("DATE('Schedule.schedule_datetime')")
			->get()
			->getResult();
	}
	function treasurerviewschedperdate($date_from, $date_to)
	{
		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->groupBy('Schedule.index_id')
			->orderBy('PaymentStatus.payment_id', 'ASC')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->groupBy('Schedule.index_id')
			->get()
			->getResult();
	}
	function treasurerviewpayment($index_id, $filter)
	{
		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->join('MSO', 'MSO.MSO_id = Schedule.MSO_id')
			->where('Schedule.index_id', $index_id)
			->where('InspectStatus.inspect_status', 'Accepted')
			->whereIn('PaymentStatus.payment_status', $filter)
			->orderBy('PaymentStatus.payment_id', 'ASC')
			->get()
			->getResult();
	}
	// Generate Data

	//PIG
	function week1pig($date_generate, $weeks1)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <", $weeks1)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}
	function week2pig($weeks1, $weeks2)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks1)
			->where("InspectStatus.inspect_datetime <", $weeks2)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}
	function week3pig($weeks2, $weeks3)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks2)
			->where("InspectStatus.inspect_datetime <", $weeks3)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}
	function week4pig($weeks3, $weeks4)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks3)
			->where("InspectStatus.inspect_datetime <", $weeks4)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}
	function week5pig($weeks4, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks4)
			->where("InspectStatus.inspect_datetime <", $weeks5)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}

	function pigstotal($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Pig')
			->countAllResults();
	}

	function pigcarcass($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->selectSum('animal_weight')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Pig')
			->get()
			->getResult();
	}

	function week1cow($date_generate, $weeks1)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <", $weeks1)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}

	function week2cow($weeks1, $weeks2)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks1)
			->where("InspectStatus.inspect_datetime <", $weeks2)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}

	function week3cow($weeks2, $weeks3)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks2)
			->where("InspectStatus.inspect_datetime <", $weeks3)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}

	function week4cow($weeks3, $weeks4)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks3)
			->where("InspectStatus.inspect_datetime <", $weeks4)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}

	function week5cow($weeks4, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks4)
			->where("InspectStatus.inspect_datetime <", $weeks5)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}

	function cowstotal($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Cow')
			->countAllResults();
	}
	function cowcarcass($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->selectSum('animal_weight')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Cow')
			->get()
			->getResult();
	}

	function week1carabao($date_generate, $weeks1)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <", $weeks1)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}

	function week2carabao($weeks1, $weeks2)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks1)
			->where("InspectStatus.inspect_datetime <", $weeks2)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}

	function week3carabao($weeks2, $weeks3)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks2)
			->where("InspectStatus.inspect_datetime <", $weeks3)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}

	function week4carabao($weeks3, $weeks4)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks3)
			->where("InspectStatus.inspect_datetime <", $weeks4)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}

	function week5carabao($weeks4, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks4)
			->where("InspectStatus.inspect_datetime <", $weeks5)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}

	function carabaostotal($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Carabao')
			->countAllResults();
	}
	function carbaocarcass($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->selectSum('animal_weight')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Carabao')
			->get()
			->getResult();
	}
	function week1horse($date_generate, $weeks1)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <", $weeks1)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}

	function week2horse($weeks1, $weeks2)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks1)
			->where("InspectStatus.inspect_datetime <", $weeks2)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}

	function week3horse($weeks2, $weeks3)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks2)
			->where("InspectStatus.inspect_datetime <", $weeks3)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}

	function week4horse($weeks3, $weeks4)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks3)
			->where("InspectStatus.inspect_datetime <", $weeks4)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}

	function week5horse($weeks4, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks4)
			->where("InspectStatus.inspect_datetime <", $weeks5)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}

	function horsestotal($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Horse')
			->countAllResults();
	}
	function horsecarcass($date_generate, $weeks5)
	{
		return $this->db->table('InspectStatus')
			->selectSum('animal_weight')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->where('Schedule.animal_type', 'Horse')
			->get()
			->getResult();
	}
	function week1others($date_generate, $weeks1)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <", $weeks1)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}

	function week2others($weeks1, $weeks2)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks1)
			->where("InspectStatus.inspect_datetime <", $weeks2)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}

	function week3others($weeks2, $weeks3)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks2)
			->where("InspectStatus.inspect_datetime <", $weeks3)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}

	function week4others($weeks3, $weeks4)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks3)
			->where("InspectStatus.inspect_datetime <", $weeks4)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}

	function week5others($weeks4, $weeks5)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $weeks4)
			->where("InspectStatus.inspect_datetime <", $weeks5)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}
	function otherstotal($date_generate, $weeks5)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->whereNotIn('Schedule.animal_type', $animals)
			->countAllResults();
	}

	function otherscarcass($date_generate, $weeks5)
	{
		$animals = ['Pig', 'Cow', 'Carabao', 'Horse'];
		return $this->db->table('InspectStatus')
			->selectSum('animal_weight')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('InspectStatus.inspect_status', 'Accepted')
			->where("InspectStatus.inspect_datetime >=", $date_generate)
			->where("InspectStatus.inspect_datetime <=", $weeks5)
			->whereNotIn('Schedule.animal_type', $animals)
			->get()
			->getResult();
	}

	//Treasurer Payment History
	function paymenthistory()
	{
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->groupBy('Schedule.schedule_datetime')
			->orderBy('Schedule.schedule_id', 'DESC')
			->get()
			->getResult();
	}
	function paymenthistoryDate($date_from, $date_to)
	{
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->orderBy('Schedule.schedule_id', 'DESC')
			->get()
			->getResult();
	}
	function paymentPendingNow()
	{
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->where('PaymentStatus.payment_status', 'Not Paid')
			->groupBy('Schedule.index_id')
			->get()
			->getResult();
	}
	function inspector_schedule_group()
	{
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.schedule_id = Schedule.schedule_id')
			->groupBy("DATE(schedule_datetime)")
			->get()
			->getResult();
	}
	function inspector_history_group()
	{
		return $this->db->table('MSO')
			->select('MSO.MSO_id AS MSO_id, InspectStatus.Inspector_id AS inspector_ID, MSO.firstname, MSO.lastname, MSO.username, MSO.address, Schedule.schedule_id, MSO.contact, Schedule.Schedule_datetime, Schedule.index_id')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.schedule_id = Schedule.schedule_id')
			->groupBy("DATE(schedule_datetime)")
			->get()
			->getResult();
	}
	function inspector_history($filter, $date_from, $date_to)
	{
		return $this->db->table('MSO')
			->select('MSO.MSO_id AS MSO_id, InspectStatus.Inspector_id AS inspector_ID, MSO.firstname, MSO.lastname,MSO.username, MSO.address,Schedule.schedule_id, MSO.contact, Schedule.schedule_datetime, Schedule.index_id, Schedule.schedule_status')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->where('DATE(Schedule.schedule_datetime) >=', $date_from)
			->where('DATE(Schedule.schedule_datetime) <=', $date_to)
			->whereIn('Schedule.schedule_status', $filter)
			->groupBy('Schedule.index_id')
			->get()
			->getResult();
	}
	function inspector_history_details($index_id, $filter)
	{
		return $this->db->table('MSO')
			->select('MSO.MSO_id AS MSO_id, InspectStatus.Inspector_id AS inspector_ID, MSO.firstname, MSO.lastname,MSO.username, MSO.address, MSO.contact,Schedule.animal_type,Schedule.animal_quantity,Schedule.animal_weight,Schedule.animal_origin, Schedule.schedule_id,InspectStatus.inspect_status, Schedule.schedule_datetime, Schedule.index_id,InspectStatus.inspect_reason,InspectStatus.Inspector_id')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->where('Schedule.index_id', $index_id)
			->whereIn('InspectStatus.inspect_status', $filter)
			// ->orWhere('InspectStatus.inspect_status', 'Rejected')
			->get()
			->getResult();
	}
	function paymentdetails($MSO_id)
	{
		return $this->db->table('MSO')
			->select('MSO.MSO_id AS MSO_id, Schedule.index_id,MSO.firstname,MSO.lastname, Schedule.Schedule_datetime')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->where('MSO.MSO_id', $MSO_id)
			->where('InspectStatus.inspect_status', 'Accepted')
			->groupBy('Schedule.index_id')
			->orderBy('PaymentStatus.payment_id', 'DESC')
			->get()
			->getResult();
	}
	function paymentanimals($index_id, $MSO_id, $filter)
	{
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->where('MSO.MSO_id', $MSO_id)
			->where('Schedule.index_id', $index_id)
			->whereIn('PaymentStatus.payment_status', $filter)
			->orderBy('PaymentStatus.payment_id', 'DESC')
			->get()
			->getResult();
	}
	function totalpayment($index_id, $MSO_id)
	{
		return $this->db->table('MSO')
			->selectSum('PaymentStatus.payment_price', 'total')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->join('PaymentStatus', 'PaymentStatus.inspectstatus_id = InspectStatus.inspectstatus_id')
			->where('MSO.MSO_id', $MSO_id)
			->where('Schedule.index_id', $index_id)
			->groupBy('Schedule.index_id')
			->orderBy('PaymentStatus.payment_id', 'DESC')
			->get()
			->getResult();
	}
	function date_disables()
	{
		$dates = $this->db->table('Schedule')
			->select('Schedule.Schedule_datetime')
			->join('InspectStatus', 'InspectStatus.Schedule_id = Schedule.Schedule_id')
			->groupBy('Schedule.index_id')
			->get()
			->getResult();

		$dateCounts = array();
		foreach ($dates as $date) {
			$formattedDate = (new DateTime($date->Schedule_datetime))->format('Y-m-d');
			if (!isset($dateCounts[$formattedDate])) {
				$dateCounts[$formattedDate] = 0;
			}
			$dateCounts[$formattedDate]++;
		}
		$schedule_limit = 15; //adjust the schedule limit 
		$disabledDates = array();
		foreach ($dateCounts as $date => $count) {
			if ($count >= $schedule_limit) {
				$disabledDates[] = $date;
			}
		}

		return json_encode($disabledDates);
	}
	function AcceptFirst($index_id)
	{
		$update = $this->db->table('Schedule')
			->set('schedule_status', 1)
			->where('index_id', $index_id)
			->update();
		return ($update !== false && $update > 0);
	}
	function rejectSchedFirst($index_id)
	{
		$update = $this->db->table('Schedule')
			->set('schedule_status', 2)
			->where('index_id', $index_id)
			->update();
		return ($update !== false && $update > 0);
	}
	function inspector_this_week()
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where("WEEK(Schedule.schedule_datetime) = WEEK('$start_date')")
			->where("Schedule.schedule_datetime >= '$start_date'")
			->where("Schedule.schedule_datetime <= '$end_date'")
			->where('Schedule.schedule_status', 1)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}
	function inspector_next_week()
	{
		$start_date = date('Y-m-d', strtotime('next week Monday')); // get the start date of the next week
		$end_date = date('Y-m-d', strtotime('next week Sunday')); // get the end date of the next week
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where("WEEK(Schedule.schedule_datetime) = WEEK('$start_date')")
			->where("Schedule.schedule_datetime >= '$start_date'")
			->where("Schedule.schedule_datetime <= '$end_date'")
			->where('Schedule.schedule_status', 1)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}
	function inspector_today()
	{
		$today = date('Y-m-d'); // get the current date

		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where('DATE(Schedule.schedule_datetime)', $today)
			->where('Schedule.schedule_status', 1)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}
	public function inspector_this_week_count()
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week

		$query = $this->db->table('Schedule')
			->distinct()
			->where("WEEK(schedule_datetime) = WEEK('$start_date')")
			->where("schedule_datetime >= '$start_date'")
			->where("schedule_datetime <= '$end_date'")
			->where('schedule_status', 1)
			->groupBy('index_id');
		return $query->countAllResults();
	}
	function inspector_today_count()
	{
		$today = date('Y-m-d'); // get the current date

		return $this->db->table('Schedule')
			->distinct()
			->select('index_id')
			->where('DATE(schedule_datetime)', $today)
			->where('schedule_status', 1)
			->countAllResults();
	}

	function inspector_next_week_count()
	{
		$start_date = date('Y-m-d', strtotime('next week Monday')); // get the start date of the next week
		$end_date = date('Y-m-d', strtotime('next week Sunday')); // get the end date of the next week

		return $this->db->table('Schedule')
			->distinct()
			->where("WEEK(schedule_datetime) = WEEK('$start_date')")
			->where("schedule_datetime >= '$start_date'")
			->where("schedule_datetime <= '$end_date'")
			->where('schedule_status', 1)
			->groupBy('index_id')
			->countAllResults();
	}

	function inspector_all_schedules_count()
	{
		$start_date = date('Y-m-d', strtotime('this week Monday')); // get the start date of this week
		return $this->db->table('Schedule')
			->distinct()
			->where('schedule_status', 1)
			->where('DATE(schedule_datetime) >=', $start_date) // filter schedules from this week onwards
			->groupBy('index_id')
			->countAllResults();
	}




	function mso_this_week($mso_id)
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where("WEEK(Schedule.schedule_datetime) = WEEK('$start_date')")
			->where("Schedule.schedule_datetime >= '$start_date'")
			->where("Schedule.schedule_datetime <= '$end_date'")
			->where('Schedule.schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}
	function mso_next_week($mso_id)
	{
		$start_date = date('Y-m-d', strtotime('next week Monday')); // get the start date of the next week
		$end_date = date('Y-m-d', strtotime('next week Sunday')); // get the end date of the next week
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where("WEEK(Schedule.schedule_datetime) = WEEK('$start_date')")
			->where("Schedule.schedule_datetime >= '$start_date'")
			->where("Schedule.schedule_datetime <= '$end_date'")
			->where('Schedule.schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}
	function mso_today_sched($mso_id)
	{
		$today = date('Y-m-d'); // get the current date
		return $this->db->table('MSO')
			->join('Schedule', 'Schedule.MSO_id = MSO.MSO_id')
			->where("DATE(Schedule.schedule_datetime) = '$today'")
			->where('Schedule.schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('Schedule.index_id')
			->limit(5)
			->get()
			->getResult();
	}

	public function mso_this_week_count($mso_id)
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week

		$query = $this->db->table('Schedule')
			->distinct()
			->where("WEEK(schedule_datetime) = WEEK('$start_date')")
			->where("schedule_datetime >= '$start_date'")
			->where("schedule_datetime <= '$end_date'")
			->where('schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('index_id');
		return $query->countAllResults();
	}

	function mso_today_count($mso_id)
	{
		$today = date('Y-m-d'); // get the current date

		return $this->db->table('Schedule')
			->distinct()
			->where("DATE(schedule_datetime) = '$today'")
			->where('schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('index_id')
			->countAllResults();
	}


	function mso_next_week_count($mso_id)
	{
		$start_date = date('Y-m-d', strtotime('next week Monday')); // get the start date of the next week
		$end_date = date('Y-m-d', strtotime('next week Sunday')); // get the end date of the next week

		return $this->db->table('Schedule')
			->distinct()
			->where("WEEK(schedule_datetime) = WEEK('$start_date')")
			->where("schedule_datetime >= '$start_date'")
			->where("schedule_datetime <= '$end_date'")
			->where('schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->groupBy('index_id')
			->countAllResults();
	}

	function mso_all_schedules_count($mso_id)
	{
		$start_date = date('Y-m-d', strtotime('this week Monday')); // get the start date of this week

		return $this->db->table('Schedule')
			->distinct()
			->where('schedule_status', 1)
			->where('Schedule.MSO_id', $mso_id)
			->where('schedule_datetime >=', $start_date) // filter schedules from this week onwards
			->groupBy('index_id')
			->countAllResults();
	}


	//Payments Dashboard
	function paymentTotal()
	{
		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->selectSum('PaymentStatus.payment_price')
			->get()
			->getRow()
			->payment_price;
	}
	function paymentTotalThisWeek()
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week

		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->selectSum('PaymentStatus.payment_price')
			->where('Schedule.schedule_datetime >=', $start_date)
			->where('Schedule.schedule_datetime <=', $end_date)
			->get()
			->getRow()
			->payment_price;
	}
	function paymentTotalLastWeek()
	{
		$start_date = date('Y-m-d', strtotime('last week')); // get the start date of the previous week
		$end_date = date('Y-m-d', strtotime('this week -1 day')); // get the end date of the previous week

		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->selectSum('PaymentStatus.payment_price')
			->where('Schedule.schedule_datetime >=', $start_date)
			->where('Schedule.schedule_datetime <=', $end_date)
			->get()
			->getRow()
			->payment_price;
	}
	function paymentPending()
	{
		return $this->db->table('PaymentStatus')
			->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
			->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
			->where('PaymentStatus.payment_status', 'Not Paid')
			->countAllResults();
	}
	function paymentTotalThisWeekPerDay()
	{
		$start_date = date('Y-m-d', strtotime('this week')); // get the start date of the current week
		$end_date = date('Y-m-d', strtotime('next week -1 day')); // get the end date of the current week

		$schedules = [];

		// Loop through each day of the week
		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', strtotime($start_date . ' + ' . $i . ' days'));

			// Query to get the sum of payments for the current day
			$query = $this->db->table('PaymentStatus')
				->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
				->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
				->selectSum('PaymentStatus.payment_price')
				->where('Schedule.schedule_datetime >=', $date)
				->where('Schedule.schedule_datetime <', date('Y-m-d', strtotime($date . ' + 1 day')))
				->get()
				->getRow();

			$schedules[] = isset($query->payment_price) ? $query->payment_price : 0;
		}

		return $schedules;
	}
	function paymentTotalLastWeekPerDay()
	{
		$start_date = date('Y-m-d', strtotime('last week')); // get the start date of the previous week
		$end_date = date('Y-m-d', strtotime('this week -1 day')); // get the end date of the previous week

		$schedules = [];

		// Loop through each day of the previous week
		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', strtotime($start_date . ' + ' . $i . ' days'));

			// Query to get the sum of payments for the current day
			$query = $this->db->table('PaymentStatus')
				->join('InspectStatus', 'InspectStatus.inspectstatus_id = PaymentStatus.inspectstatus_id')
				->join('Schedule', 'Schedule.schedule_id = InspectStatus.schedule_id')
				->selectSum('PaymentStatus.payment_price')
				->where('Schedule.schedule_datetime >=', $date)
				->where('Schedule.schedule_datetime <', date('Y-m-d', strtotime($date . ' + 1 day')))
				->get()
				->getRow();

			$schedules[] = isset($query->payment_price) ? $query->payment_price : 0;
		}

		return $schedules;
	}
}
