<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Student;

class Matricziauddinscience extends Model
{
    //

	protected $table = 'Matricziauddinscience';

	public function studentinfo(){
		return $this->belongsTo('App\Student','enrollmentnumber','matricexamuniquekey');
	}


	





}
