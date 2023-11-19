<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ur_uid')->unsigned();
            $table->integer('ur_rid')->unsigned();
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        Schema::table('user_roles', function(Blueprint $table)
        {
            $table->foreign('ur_uid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ur_rid')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
