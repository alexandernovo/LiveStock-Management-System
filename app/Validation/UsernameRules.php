<?php

namespace App\Validation;

use App\Models\DAStaffModel;
use App\Models\MSOModel;
use App\Models\InspectorModel;
use App\Models\TreasurerModel;

class UsernameRules
{
        public function validateUsername(string $str, string $fields, array $data)
        {
                $dastaffmodel   = new DAStaffModel();
                $msomodel       = new MSOModel();
                $inspectormodel = new InspectorModel();
                $treasurermodel = new TreasurerModel();

                if ($user = $dastaffmodel->where('DAStaff_username', $data['username'])->first()) {
                        return true;
                } else if ($user = $msomodel->where('username', $data['username'])->first()) {
                        return true;
                } else if ($user = $inspectormodel->where('username', $data['username'])->first()) {
                        return true;
                } else if ($user = $treasurermodel->where('username', $data['username'])->first()) {
                        return true;
                } else {
                        return false;
                }
        }
        public function validateStatus(string $str, string $fields, array $data)
        {
                $msomodel       = new MSOModel();
                $inspectormodel = new InspectorModel();
                $treasurermodel = new TreasurerModel();

                if ($user = $msomodel->where('username', $data['username'])->first()) {
                        if ($user['status'] == 0) {
                                return false;
                        } else {
                                return true;
                        }
                } else if ($user = $inspectormodel->where('username', $data['username'])->first()) {
                        if ($user['status'] == 0) {
                                return false;
                        } else {
                                return true;
                        }
                } else if ($user = $treasurermodel->where('username', $data['username'])->first()) {
                        if ($user['status'] == 0) {
                                return false;
                        } else {
                                return true;
                        }
                }
        }
}
