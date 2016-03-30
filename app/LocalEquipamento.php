<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalEquipamento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'descricao','active' ];
    
    /**
     * Get all of the unidades for the orgao.
     */
    
    public function equipamentos()
    {
        return $this->hasMany('App\Equipamento');
    }
}
