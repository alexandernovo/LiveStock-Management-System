<?php

namespace App\Validation;

class MSOValidation
{
    public function validatePasswordMSO(string $str, string $fields, array $data)
    {
        if (password_verify($data['password'], session()->get('MSO_password'))) {
            return true;
        } else {
            return false;
        }
    }
    public function validateCurrentPasswordMSO(string $str, string $fields, array $data)
    {
        if (password_verify($data['currentpass'], session()->get('MSO_password'))) {
            return true;
        } else {
            return false;
        }
    }
    public function validateNewPasswordMSO(string $str, string $fields, array $data)
    {
        if (password_verify($data['newpass'], session()->get('MSO_password'))) {
            return false;
        } else {
            return true;
        }
    }
}
