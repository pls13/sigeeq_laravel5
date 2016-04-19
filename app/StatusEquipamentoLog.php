<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusEquipamentoLog extends Model
{
    protected $table = 'status_equipamentos_log';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function status()
    {
        return $this->belongsTo('App\EStatus' );
    }
    
    public function equipamento()
    {
        return $this->belongsTo('App\Equipamento' );
    }
}
