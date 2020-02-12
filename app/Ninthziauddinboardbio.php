<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Ninthziauddinboardbio extends Model
{
    //

    public function studentinfo(){
		error_log("Student info");
		error_log($this);
		return $this->belongsTo('App\Student','enrollmentnumber','ninthexamuniquekey');
	}
}
