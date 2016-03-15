<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    
    /**
     * Get the Orgao that owns the unidade.
     */
    public function user()
    {
        return $this->belongsTo(Orgao::class);
    }
}
