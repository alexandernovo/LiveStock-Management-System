<?php

namespace App\Validation;

class TreasurerValidation
{
    public function validatePasswordTreasurer(string $str, string $fields, array $data)
    {
        if (password_verify($data['password'], session()->get('Treasurer_password'))) {
            return true;
        } else {
            return false;
        }
    }
    public function validateCurrentPasswordTreasurer(string $str, string $fields, array $data)
    {
        if (password_verify($data['currentpass'], session()->get('Treasurer_password'))) {
            return true;
        } else {
            return false;
        }
    }
    public function validateNewPasswordTreasurer(string $str, string $fields, array $data)
    {
        if (password_verify($data['newpass'], session()->get('Treasurer_password'))) {
            return false;
        } else {
            return true;
        }
    }
}
