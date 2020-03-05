<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hsconehumanities extends Model
{
    protected $guarded = [];

    public function studentinfo(){
		return $this->belongsTo('App\Student','enrollmentnumber','firstyearexamuniquekey');
	}
}
