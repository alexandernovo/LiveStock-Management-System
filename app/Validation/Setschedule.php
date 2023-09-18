<?php
namespace App\Validation;

class Setschedule
{
    public function setsched(string $str=null):bool
    {
  
      $curdate=date("Y/m/d");
      $date1=date_create($curdate);
      $date2=date_create($str);
      if($date1<$date2)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
}