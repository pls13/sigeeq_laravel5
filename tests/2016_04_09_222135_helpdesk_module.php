<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HelpdeskModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name')->unsigned();
            $table->text('description')->nullable();
            $table->boolean('active')->default();
            $table->timestamps();
        });
        
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name')->unsigned();
            $table->text('description')->nullable();
            $table->boolean('active')->default();
            $table->timestamps();
        });
        
        Schema::create('priority', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name')->unsigned();
            $table->text('description')->nullable();
            $table->boolean('active')->default();
            $table->timestamps();
        });
        //ticket
         Schema::create('ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->integer('reporter_id')->unsigned();
            $table->integer('handler_id')->unsigned();
            $table->enum('visibility',['public','private'])->unsigned();
            $table->string('summary', 150);
            $table->text('description')->nullable();
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
        //
    }
}
