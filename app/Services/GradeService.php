<?php

namespace App\Services;


class GradeService
{
    public function __construct()
    {
    }
    public function passedSubjects($arr){
        return array_filter($arr,function($arrvalue){

            return $arrvalue > 33;
        });
    }
    public function totalOfMandatorySubjects($item){
        return $item['englishmarks'] + $item['urdumarks'] + $item['islamiatmarks'];
    }
    public function getPercentage($marks,$outOf){
        return $marks/$outOf* 100;
    }
    public function gradecalculation($totalmarks){
        error_log($totalmarks);

        if ($totalmarks > 680)
        {
            return "A";
        }

        elseif ($totalmarks > 594 and $totalmarks <= 670 ){
            return "B";
        }

        elseif ($totalmarks > 509 and $totalmarks <= 594 ){
            return "C";
        }

        elseif ($totalmarks > 424 and $totalmarks <= 509 ){
            return "D";
        }

        elseif ($totalmarks > 339 and $totalmarks <= 424 ){
            return "D";
        }

        else if ($totalmarks < 340){
            return "E";
        }

     }

}
