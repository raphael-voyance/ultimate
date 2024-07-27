<?php

namespace App\Policies;

use App\Models\User;

class AuthorizationRoles
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user)
    {
        return $user->hasRole('Admin');
    }

    public function consultant(User $user)
    {
        return $user->hasRole('Consultant');
    }
}
