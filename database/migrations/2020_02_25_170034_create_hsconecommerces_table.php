<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsconecommercesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsconecommerces', function (Blueprint $table) {
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
            $table->unsignedInteger('accountingmarks')->nullable();
            $table->unsignedInteger('commercemarks')->nullable();
            $table->string('economicsmarks')->nullable();
            $table->string('mathmarks')->nullable();
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
        Schema::dropIfExists('hsconecommerces');
    }
}
