<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\School;
use App\Ninthziauddinboardcomputer;
use App\Ninthziauddinboardbio;
use App\Ninthziauddinboardgeneralgroup;

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


  public function ninthbiodata(){
  	return $this->belongsTo('App\Ninthziauddinboardbio','ninthexamuniquekey','enrollmentnumber');
  }


public function ninthgeneraldata(){
  	return $this->belongsTo('App\Ninthziauddinboardgeneralgroup','ninthexamuniquekey','enrollmentnumber');
  }


}
