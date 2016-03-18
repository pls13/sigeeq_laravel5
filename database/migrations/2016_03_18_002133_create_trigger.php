<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER trg_insert_equipamento_log AFTER INSERT ON equipamentos
        FOR EACH ROW BEGIN
            INSERT INTO equipamentos_log (equipamento_id, unidade_id, tipo_id, local_id, last_user_id, patrimonio, observacao, active, fires)
            VALUES(NEW.id, NEW.unidade_id, NEW.tipo_id, NEW.local_id, NEW.last_user_id, NEW.patrimonio, NEW.observacao, NEW.active, 'I');
        END;
        ");
        
        DB::unprepared("
        CREATE TRIGGER trg_update_equipamento_log AFTER UPDATE ON equipamentos
        FOR EACH ROW BEGIN
            INSERT INTO equipamentos_log (equipamento_id, unidade_id, tipo_id, local_id, last_user_id, patrimonio, observacao, active, fires)
            VALUES(NEW.id, NEW.unidade_id, NEW.tipo_id, NEW.local_id, NEW.last_user_id, NEW.patrimonio, NEW.observacao, NEW.active, 'U');
        END;
        ");
        
        DB::unprepared("
        CREATE TRIGGER trg_delete_equipamento_log BEFORE DELETE ON equipamentos
        FOR EACH ROW BEGIN
            INSERT INTO equipamentos_log (equipamento_id, unidade_id, tipo_id, local_id, last_user_id, patrimonio, observacao, active, fires)
            VALUES(OLD.id, OLD.unidade_id, OLD.tipo_id, OLD.local_id, OLD.last_user_id, OLD.patrimonio, OLD.observacao, OLD.active, 'D');
        END;
        ");
        
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
