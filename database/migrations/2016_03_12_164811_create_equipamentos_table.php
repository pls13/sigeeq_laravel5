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
            $table->string('patrimonio', 30)->unique();
            $table->text('observacao')->nullable();
            $table->boolean('active')->default(TRUE);
            $table->softDeletes();
            $table->timestamps();
                        
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->foreign('tipo_id')->references('id')->on('tipo_equipamentos');
            $table->foreign('local_id')->references('id')->on('local_equipamentos');
            $table->foreign('last_user_id')->references('id')->on('users');
        });
        
        
        Schema::create('e_status', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome', 50);
            $table->text('descricao')->nullable();
            $table->string('html_class', 20)->nullable();
            $table->boolean('active')->default(TRUE);
        });
        DB::table('e_status')->insert(['nome' => 'OK','descricao'=> ' Funcionando','html_class'=>'sts_ok']);
        DB::table('e_status')->insert(['nome' => 'Falha','descricao'=> ' Mal funcionamento','html_class'=>'sts_falha']);
        DB::table('e_status')->insert(['nome' => 'Descarte','descricao'=> ' Equipamento para descarte','html_class'=>'sts_descarte']);
        DB::table('e_status')->insert(['nome' => 'Descartado', 'descricao'=> ' Equipamento descartado', 'html_class' => 'sts_descartado']);
        DB::table('e_status')->where('id','=',4)->update(['id' => 0]);
        
        Schema::create('status_equipamentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('equipamento_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->text('descricao')->nullable();
            $table->timestamps();
                
            $table->foreign('status_id')->references('id')->on('e_status');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
            $table->foreign('user_id')->references('id')->on('users');
        });
        
        Schema::create('status_equipamentos_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_equipamentos_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('equipamento_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->text('descricao')->nullable();
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
        Schema::drop('status_equipamentos_log');
        Schema::drop('status_equipamentos');
        Schema::drop('e_status');
        Schema::drop('equipamentos');
    }
}
