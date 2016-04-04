<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'descricao','active' ];
    
    
    private $canDelete = NULL;

    /**
     * Get all of the unidades for the equipamemtos.
     */
    
    public function equipamentos()
    {
        return $this->hasMany('App\Equipamento', 'local_id');
    }
    
    public function canDelete() {
        if(is_null($this->canDelete)){
            $this->canDelete = is_null(DB::table('equipamentos_log')->where('tipo_id','=',$this->id)->first());
        }
        return $this->canDelete;
    }

}
