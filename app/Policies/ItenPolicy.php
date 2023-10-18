<?php

namespace App\Policies;

use App\Models\User;
use App\Models\iten;
use Illuminate\Auth\Access\Response;

class ItenPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, iten $iten): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, iten $iten): Response
    {
        return $user->id === 1
            ? Response::allow()
            : Response::deny('Sem acesso');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, iten $iten): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, iten $iten): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, iten $iten): bool
    {
        //
    }
}