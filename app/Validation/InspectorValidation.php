<?php
namespace App\Validation;

class InspectorValidation
{
    public function validatePasswordInspector(string $str, string $fields, array $data)
    {
            if(password_verify($data['password'], session()->get('Inspector_password')))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
    public function validateCurrentPasswordInspector(string $str, string $fields, array $data)
    {
            if(password_verify($data['currentpass'], session()->get('Inspector_password')))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
    public function validateNewPasswordInspector(string $str, string $fields, array $data)
    {
        if(password_verify($data['newpass'], session()->get('Inspector_password')))
        {
            return false;    
        }
        else
        {
            return true;
        }
    }
      
}