<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHscpreengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hscpreengs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('schoolid');
            $table->string('studentname');
            $table->string('studentfathername');
            $table->string('studentrollnumber')->unique();
            $table-> unsignedInteger('englishmarks');
            $table-> unsignedInteger('matricpassingyear');
            $table-> unsignedInteger('yearappearing');
            $table->unsignedInteger ('urdumarks');
            $table->unsignedInteger('islamiatmarks');
            $table->unsignedInteger('physicspracticalmarks');
            $table->unsignedInteger('physicstheorymarks');
            $table->string('chemistrytheorymarks');
            $table->string('chemistrypracticalmarks');
            $table->unsignedInteger('mathmarks');
            $table->unsignedInteger('totalmarks');
            $table->decimal('percentage',5,2);
            $table->string('grade');
            $table->foreign('schoolid')->references('id')->on('schools');
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
        Schema::dropIfExists('hscpreengs');
    }
}
