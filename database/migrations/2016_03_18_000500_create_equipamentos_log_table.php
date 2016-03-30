<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosLogTable extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipamento_id')->nullable();
            $table->integer('unidade_id')->nullable();
            $table->integer('tipo_id')->nullable();
            $table->integer('local_id')->nullable();
            $table->integer('last_user_id')->nullable();
            $table->string('patrimonio', 20)->nullable();
            $table->text('observacao')->nullable();
            $table->boolean('active')->nullable();
            $table->enum('fires', ['D','U','I'])->nullable();
            $table->timestamp('created_at')->useCurrent = TRUE;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipamentos_log');
    }
}
