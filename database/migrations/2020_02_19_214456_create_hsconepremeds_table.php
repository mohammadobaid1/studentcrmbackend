<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsconepremedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsconepremeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('schoolid');
            $table->string('studentname');
            $table->string('studentfathername');
            $table->string('studentrollnumber')->unique();
            $table-> unsignedInteger('englishmarks')->nullable();
            $table-> unsignedInteger('matricpassingyear');
            $table-> unsignedInteger('yearappearing');
            $table->unsignedInteger ('urdumarks')->nullable();
            $table->unsignedInteger('islamiatmarks')->nullable();
            $table->unsignedInteger('physicspracticalmarks')->nullable();
            $table->unsignedInteger('physicstheorymarks')->nullable();
            $table->string('chemistrytheorymarks')->nullable();
            $table->string('chemistrypracticalmarks')->nullable();
            $table->unsignedInteger('zoologymarks')->nullable();
            $table->unsignedInteger('botanymarks')->nullable();
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
        Schema::dropIfExists('hsconepremeds');
    }
}
