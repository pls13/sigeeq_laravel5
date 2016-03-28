<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unidade_id', 'tipo_id', 'local_id', 'last_user_id', 'patrimonio', 'observacao', 'active'];
    
    /**
     * Get the  user that perform last update
     */
    public function lastUser()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the  local 
     */
    public function local()
    {
        return $this->belongsTo(LocalEquipamento::class);
    }
    /**
     * Get the  tipo
     */
    public function tipo()
    {
        return $this->belongsTo(TipoEquipamento::class);
    }
    /**
     * Get the  unidade
     */
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
        
    
//    public static function getListaByUserUnidades
//            retur
//        
//    }
}
