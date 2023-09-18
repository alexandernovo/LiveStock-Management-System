<?php
namespace App\Validation;

class DAStaffValidation
{
    public function validatePasswordAdmin(string $str, string $fields, array $data)
    {
            if(password_verify($data['password'], session()->get('Admin_password')))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
    public function validateCurrentPasswordAdmin(string $str, string $fields, array $data)
    {
            if(password_verify($data['currentpass'], session()->get('Admin_password')))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
    public function validateNewPasswordAdmin(string $str, string $fields, array $data)
    {
        if(password_verify($data['newpass'], session()->get('Admin_password')))
        {
            return false;    
        }
        else
        {
            return true;
        }
    }
      
}