<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsconegeneralsciencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsconegeneralsciences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('schoolid');
            $table->string('studentname');
            $table->string('studentfathername');
            $table->string('studentrollnumber')->unique();
            $table-> unsignedInteger('englishmarks')->nullable();
            $table-> unsignedInteger('matricpassingyear');
            $table-> unsignedInteger('yearappearing')->nullable();
            $table->unsignedInteger ('urdumarks')->nullable();
            $table->unsignedInteger('islamiatmarks')->nullable();
            $table->unsignedInteger('physicspracticalmarks')->nullable();
            $table->unsignedInteger('statspracticalmarks')->nullable();
            $table->unsignedInteger('physicstheorymarks')->nullable();
            $table->unsignedInteger('statstheorymarks')->nullable();
            $table->string('computertheorymarks')->nullable();
            $table->string('computerpracticalmarks')->nullable();
            $table->unsignedInteger('mathmarks')->nullable();
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
        Schema::dropIfExists('hsconegeneralsciences');
    }
}
