<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Editstudenttable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            DB::statement('ALTER table `students` MODIFY `enrollmentnumber` varchar(255)');
            DB::statement('ALTER table `students` MODIFY `matricenrollmentnumber` varchar(255)');
            DB::statement('ALTER table `students` MODIFY `firstyearenrollmentnumber` varchar(255)');
            DB::statement('ALTER table `students` MODIFY `secondyearenrollmentnumber` varchar(255)');
        });
    }
}
