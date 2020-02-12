<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\School;
use App\Ninthziauddinboardcomputer;

class Student extends Model
{
    //

  protected $fillable = ["enrollmentnumber","studentname","fathername","dateofbirth","schoolid","ninthexamuniquekey","matricexamuniquekey","firstyearexamuniquekey","secondyearexamuniquekey","matricenrollmentnumber","firstyearenrollmentnumber","secondyearenrollmentnumber"];


  public function schoolname(){
  	return $this->belongsTo('App\School','schoolid');
  }

  public function ninthcomputerdata(){
  	return $this->belongsTo('App\Ninthziauddinboardcomputer','ninthexamuniquekey','enrollmentnumber');
  }
}
