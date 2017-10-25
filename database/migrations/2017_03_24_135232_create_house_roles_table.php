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
            $table->string('user_id');
            $table->integer('role_level')->unsigned()->nullable();
            $table->string('role_title')->nullable();
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('house_roles', function($table) {
            $table->dropForeign('house_roles_house_id_foreign');
            $table->dropForeign('house_roles_user_id_foreign');
        });

        Schema::dropIfExists('house_roles');
    }
}
