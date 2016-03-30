<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'sigla','active' ];
    
    /**
     * Get all of the unidades for the orgao.
     */
    
    public function unidades()
    {
        return $this->hasMany('App\Unidade');
    }
}
