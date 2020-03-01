<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsconehumanitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsconehumanities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enrollmentnumber')->unique();
            $table-> unsignedInteger('englishmarks')->nullable();
            $table-> unsignedInteger('matricyear')->nullable();
            $table-> unsignedInteger('yearappearing');
            $table->unsignedInteger ('urdumarks')->nullable();
            $table->unsignedInteger('islamiatmarks')->nullable();
            $table->unsignedInteger('civicsmarks')->nullable();
            $table->unsignedInteger('sociologymarks')->nullable();
            $table->unsignedInteger('educationsmarks')->nullable();
            $table->unsignedInteger('islamichistorymarks')->nullable();
            $table->unsignedInteger('islamicstudiesmarks')->nullable();
            $table->unsignedInteger('economicsmarks')->nullable();
            $table->unsignedInteger('generalhistorymarks')->nullable();
            $table->unsignedInteger('totalmarks');
            $table->unsignedInteger('totalclearedpaper');
            $table->decimal('percentage',5,2);
            $table->string('grade');
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
        Schema::dropIfExists('hsconehumanities');
    }
}
