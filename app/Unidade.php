<?php

namespace App;

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
}
