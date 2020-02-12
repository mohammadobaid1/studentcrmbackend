<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNinthziauddinboardcomputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninthziauddinboardcomputers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enrollmentnumber');
            $table->unsignedInteger('EnglishMarks');
            $table->unsignedInteger('SindhiMarks');
            $table->unsignedInteger('PakistanStudiesMark');
            $table->unsignedInteger('ChemistryMarks');
            $table->unsignedInteger('ComputerTheoryMarks');
            $table->unsignedInteger('ComputerPracticalMarks');
            $table->unsignedInteger('TotalComputerMarks');
            $table->unsignedInteger('TotalMarks');
            $table->unsignedInteger('Percentage');
            $table->string('PassingStatus');
            $table->decimal('EnglishPercentage',5,2);
            $table->decimal('SindhiPercentage',5,2);
            $table->decimal('PakistanStudiesPercentage',5,2);
            $table->decimal('ChemistryPercentage',5,2);
            $table->decimal('ComputerPercentage',5,2);
            $table->decimal('OverallPercentage',5,2);
            $table->string('Totalclearedpaper');
            $table->string('grade');
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
        Schema::dropIfExists('ninthziauddinboardcomputers');
    }
}
