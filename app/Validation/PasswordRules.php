<?php

namespace App\Validation;

use App\Models\DAStaffModel;
use App\Models\MSOModel;
use App\Models\InspectorModel;
use App\Models\TreasurerModel;

class PasswordRules
{
    public function validatePassword(string $str, string $fields, array $data)
    {
        $dastaffmodel   = new DAStaffModel();
        $msomodel       = new MSOModel();
        $inspectormodel = new InspectorModel();
        $treasurermodel = new TreasurerModel();

        if ($user = $dastaffmodel->where('DAStaff_username', $data['username'])->first()) {
            if (password_verify($data['password'], $user['DAStaff_password'])) {
                return true;
            } else {
                return false;
            }
        } else if ($user = $msomodel->where('username', $data['username'])->first()) {
            if (password_verify($data['password'], $user['password'])) {
                return true;
            } else {
                return false;
            }
        } else if ($user = $inspectormodel->where('username', $data['username'])->first()) {
            if (password_verify($data['password'], $user['password'])) {
                return true;
            } else {
                return false;
            }
        } else if ($user = $treasurermodel->where('username', $data['username'])->first()) {
            if (password_verify($data['password'], $user['password'])) {
                return true;
            } else {
                return false;
            }
        }
    }
}
