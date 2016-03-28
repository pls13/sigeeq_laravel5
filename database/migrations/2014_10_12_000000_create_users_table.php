<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->string('name', 150);
            $table->string('username', 10)->unique();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->boolean('active')->default(TRUE);
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('profile_id')->references('id')->on('user_profiles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');

    }
}
