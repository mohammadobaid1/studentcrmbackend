<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricziauddingeneral extends Model
{
    //



	public function studentinfo(){
		return $this->belongsTo('App\Student','enrollmentnumberunique','matricexamuniquekey');
	}


}
