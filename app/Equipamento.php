<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Equipamento extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unidade_id', 'tipo_id', 'local_id', 
        'last_user_id', 'patrimonio', 'observacao', 'active'];
    
    //private $status = NULL;
    
    
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
    /**
     * Get the  status
     */
    public function status()
    {   
        return $this->hasOne('App\StatusEquipamento');
    }

}
