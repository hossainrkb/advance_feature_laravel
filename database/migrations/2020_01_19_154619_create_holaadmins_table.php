<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolaadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holaadmins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("hola_admin_name");
            $table->string("hola_admin_email");
            $table->string("hola_admin_pass");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holaadmins');
    }
}
