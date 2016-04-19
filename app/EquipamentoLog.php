<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipamentoLog extends Model
{
    
    protected $table = 'equipamentos_log';
    /**
     * Get the  user that perform last update
     */
    public function lastUser()
    {
        return $this->belongsTo('App\User','last_user_id');
    }
    /**
     * Get the  local 
     */
    public function local()
    {
        return $this->belongsTo('App\LocalEquipamento');
    }
    /**
     * Get the  tipo
     */
    public function tipo()
    {
        return $this->belongsTo('App\TipoEquipamento');
    }
    /**
     * Get the  unidade
     */
    public function unidade()
    {
        return $this->belongsTo('App\Unidade');
    }
    

}
