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
    
    /**
     * Get the Orgao that owns the unidade.
     */
    public function orgao()
    {
        return $this->hasOne(Orgao::class);
    }
    
    public function tecnico()
    {
        return $this->hasOne(User::class, 'tecnico_id');
    }
}
