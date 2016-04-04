<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','profile_id', 'username', 'email', 'password', 'active'
    ];
    
    private $canDelete = NULL;
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];
    
    public function profile()
    {
        return $this->belongsTo('App\UserProfile');
    }
    
    public function unidade()
    {
        return $this->hasOne('App\Unidade', 'tecnico_id');
    }
    
    public function canDelete() {
        if(is_null($this->canDelete)){
            $this->canDelete = is_null(DB::table('equipamentos_log')->where('last_user_id','=',$this->id)->first());
        }
        return $this->canDelete;
    }
    
}
