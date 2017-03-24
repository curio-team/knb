<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create a role pivot table for a user with a house
        Schema::create('house_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id')->unsigned();
            $table->integer('role_level')->unsigned();
            $table->string('role_title');
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('houses');
        });

        // Create the users reference to their house
        Schema::table('users', function($table){
            $table->integer('house_role_id')->unsigned();

            $table->foreign('house_role_id')->references('id')->on('house_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the users reference to their house
        Schema::table('users', function($table){
            $table->dropForeign('users_house_role_id_foreign');
        });

        Schema::table('house_roles', function($table){
            $table->dropForeign('house_roles_house_id_foreign');
        });

        Schema::dropIfExists('house_roles');
    }
}
