<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNinthziauddinboardgeneralgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       


             Schema::create('ninthziauddinboardgeneralgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enrollmentnumber');
            $table->string('EnglishMarks');
            $table->string('SindhiMarks');
            $table->string('PakistanStudiesMark');
            $table->string('GeneralScienceMarks');
            $table->string('MathsMarks');
            $table->string('TotalMarks');
            $table->string('Percentage');
            $table->string('PassingStatus');
            $table->decimal('EnglishPercentage',5,2);
            $table->decimal('SindhiPercentage',5,2);
            $table->decimal('PakistanStudiesPercentage',5,2);
            $table->decimal('GeneralSciencePercentage',5,2);
            $table->decimal('MathsPercentage',5,2);
            $table->decimal('OverallPercentage',5,2);
            $table->string('Totalclearedpaper');
            $table->string('grade');
            $table->string('examtype');
            $table->string('group');
            $table->foreign('enrollmentnumber')->references('enrollmentnumber')->on('students');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ninthziauddinboardgeneralgroups');
    }
}
