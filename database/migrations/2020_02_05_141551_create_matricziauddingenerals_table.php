<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatricziauddingeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricziauddingenerals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enrollmentnumberunique')->unique();
            $table->string('EnglishMarks');
            $table->string('UrduMarks');
            $table->string('IslamiatorethicsMarks');
            $table->string('physicstheorymarks');
            $table->string('physicspracticalmarks');
            $table->string('MathsMarks');
            $table->string('IslamicstudiesMarks');
            $table->string('CommerceMarks');
            $table->string('GeographyMarks');
            $table->string('CivicsMarks');
            $table->string('EconomicsMarks');
            $table->decimal('EnglishPercentage',5,2);
            $table->decimal('UrduPercentage',5,2);
            $table->decimal('Optionalsubjectspercentage',5,2);
            $table->string('TotalMarks');
            $table->decimal('OverallPercentage',5,2);
            $table->string('Totalclearedpaper');
            $table->string('grade');
            $table->string('examtype');
            $table->string('OptionalSubjectCode');
            $table->foreign('enrollmentnumberunique')->references('matricexamuniquekey')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matricziauddingenerals');
    }
}
