<?php

namespace App\Services;


class GradeService
{
    public function __construct()
    {
    }
    public function gradecalculation($percentage){
        error_log($percentage);

        if ($percentage > 80)
        {
            return "A";
        }

        elseif ($percentage > 70 and $percentage <= 80 ){
            return "B";
        }

        elseif ($percentage > 60 and $percentage <= 70 ){
            return "C";
        }

        elseif ($percentage > 50 and $percentage <= 60 ){
            return "D";
        }

        else {
            return "N/A";
        }

     }

}
