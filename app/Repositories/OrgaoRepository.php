<?php

namespace App\Repositories;

use App\User;
use App\Orgao;

class OrgaoRepository
{
    /**
     * Get all of the orgao
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Orgao::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
