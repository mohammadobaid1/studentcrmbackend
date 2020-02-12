<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Deletephysicsmarksfrommatricgeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matricziauddingenerals', function (Blueprint $table) {
            $table->dropColumn(['physicstheorymarks','physicspracticalmarks']);

            //
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
