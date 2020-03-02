<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models users.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the models user.
     *
     * @param User $user
     * @param User $routeUser
     *
     * @return mixed
     */
    public function view(User $user, User $routeUser)
    {
    }

    /**
     * Determine whether the user can create models users.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the models user.
     *
     * @param User $user
     * @param User $routeUser
     *
     * @return mixed
     */
    public function update(User $user, User $routeUser)
    {
        return $user->is($routeUser);
    }

    /**
     * Determine whether the user can update the models user.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function updatePassword(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can delete the models user.
     *
     * @param User $user
     * @param User $routeUser
     *
     * @return mixed
     */
    public function delete(User $user, User $routeUser)
    {
    }

    /**
     * Determine whether the user can restore the models user.
     *
     * @param User $user
     * @param User $routeUser
     *
     * @return mixed
     */
    public function restore(User $user, User $routeUser)
    {
    }

    /**
     * Determine whether the user can permanently delete the models user.
     *
     * @param User $user
     * @param User $routeUser
     *
     * @return mixed
     */
    public function forceDelete(User $user, User $routeUser)
    {
    }
}
