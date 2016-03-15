<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tecnico_id')->unsigned();            
            $table->integer('orgao_id')->unsigned();            
            $table->string('nome', 150)->unique();
            $table->string('sigla', 6)->unique();
            $table->string('rua', 150)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('nome_diretor', 50)->nullable();
            $table->timestamps();
                
            $table->foreign('tecnico_id')->references('id')->on('users');
            $table->foreign('orgao_id')->references('id')->on('orgaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unidades');
    }
}
