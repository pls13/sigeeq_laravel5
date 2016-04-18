<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusEquipamento extends Model
{
    protected $fillable = ['user_id','status_id','equipamento_id', 'descricao'];

    //
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
