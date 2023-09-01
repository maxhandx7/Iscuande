<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTypePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isAdmin(User $user)
    {
        return $user->tipo === 'ADMIN';
    }

    public function isPaciente(User $user)
    {
        return $user->tipo === 'PACIENTE';
    }

    public function isMedico(User $user)
    {
        return $user->tipo === 'MEDICO';
    }
}
