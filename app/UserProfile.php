<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Profile
 *
 * @author isadora
 */
class UserProfile extends Model{
    
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
