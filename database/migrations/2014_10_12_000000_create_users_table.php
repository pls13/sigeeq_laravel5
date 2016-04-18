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
            $table->string('username', 20)->unique();
            $table->string('email', 150);
            $table->string('password');
            $table->boolean('active')->default(TRUE);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('profile_id')->references('id')->on('user_profiles');
        });
        DB::table('users')->insert(
                ['profile_id' => 1, 
                'name'=> 'root',
                'username'=>'root',
                'email' => 'pls13web@gmail.com',
                'password' => '$10$pVBZPDcVCVlvQ6U0hXoIFeW00wt7Ep9LsNQm2wffDz3xtSwAl7QMm']);
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
