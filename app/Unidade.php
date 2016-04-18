<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    
    
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tecnico_id', 'orgao_id', 'nome', 'sigla', 'rua',
        'numero','bairro','telefone','nome_diretor'];
    
    private $canDelete = NULL;
  
    public function orgao()
    {
        return $this->belongsTo('App\Orgao');
    }
    
    public function tecnico()
    {
        return $this->belongsTo('App\User', 'tecnico_id');
    }
    
    public function equipamentos()
    {
        return $this->hasMany('App\Equipamento');
    }
    
    public function canDelete() {
        if(is_null($this->canDelete)){
            $this->canDelete = is_null(DB::table('equipamentos_log')->where('unidade_id','=',$this->id)->first());
        }
        return $this->canDelete;
    }
   
    public function setTecnicoId($user_id){
        $this->tecnico_id = $user_id;
    }
    
}
