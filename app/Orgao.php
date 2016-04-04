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
    
    private $canDelete = NULL;
    /**
     * Get all of the unidades for the orgao.
     */
    
    public function unidades()
    {
        return $this->hasMany('App\Unidade');
    }
        
    public function canDelete() {
        if(is_null($this->canDelete)){
            $this->canDelete = ($this->unidades()->count()==0);
        }
        return $this->canDelete;
    }
}
