<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcolumnsinmatricgeneralgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matricziauddingenerals', function (Blueprint $table) {
            //

            $table->decimal('MathsPercentage',5,2);
            $table->decimal('IslamiatorethicsPercentage',5,2);
            $table->decimal('Optionalsubjectpercentage',5,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matricziauddingenerals', function (Blueprint $table) {
            //
        });
    }
}
