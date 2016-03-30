<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('unidade_id')->unsigned();            
            $table->integer('tipo_id')->unsigned();            
            $table->integer('local_id')->unsigned();            
            $table->integer('last_user_id')->unsigned();            
            $table->string('patrimonio', 20)->unique();
            $table->text('observacao')->nullable();
            $table->boolean('active')->default(TRUE);
            $table->timestamps();
                
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->foreign('tipo_id')->references('id')->on('tipo_equipamentos');
            $table->foreign('local_id')->references('id')->on('local_equipamentos');
            $table->foreign('last_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipamentos');
    }
}
