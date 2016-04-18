<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EStatus extends Model
{
    protected $table = 'e_status';

    
    public function local()
    {
        return $this->hasMany('App\StatusEquipamento');
    }
}
