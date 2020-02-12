<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatricScienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Matricziauddinscience', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enrollmentnumber');
            $table->string('EnglishMarks');
            $table->string('UrduMarks');
            $table->string('MathsMarks');
            $table->string('IslamiatorethicsMarks');
            $table->string('PhysicsMarks');
            $table->string('TotalMarks');
            $table->string('Percentage');
            $table->string('PassingStatus');
            $table->decimal('EnglishPercentage',5,2);
            $table->decimal('UrduPercentage',5,2);
            $table->decimal('MathsPercentage',5,2);
            $table->decimal('IslamiatorethicsPercentage',5,2);
            $table->decimal('PhysicsPercentage',5,2);
            $table->decimal('OverallPercentage',5,2);
            $table->string('Totalclearedpaper');
            $table->string('grade');
            $table->string('examtype');
            $table->string('OptionalSubjectCode');
            $table->foreign('enrollmentnumber')->references('matricenrollmentnumber')->on('students');
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
        Schema::dropIfExists('Matricziauddinscience');
    }
}
