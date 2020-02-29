<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hsconepremed extends Model
{
    protected $guarded = [];

    public function studentinfo(){
		return $this->belongsTo('App\Student','enrollmentnumber','firstyearexamuniquekey');
	}
}
