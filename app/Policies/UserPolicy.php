<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    const ADMIN_ROLE = 'admin';

    /**
     * Determine whether the user is an admin.
     *
     * @param $user
     * @param $ability
     *
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->role->name === self::ADMIN_ROLE) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param \App\User $editing_user
     * @param \App\User $edited_user
     *
     * @return mixed
     */
    public function view(User $editing_user, User $edited_user)
    {
        return $editing_user->id == $edited_user->id;
    }

    /**
     * Determine whether the user can view the company info.
     *
     * @param User $user
     *
     * @return mixed;
     */
    public function viewCompanyInfo(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the company info.
     *
     * @param \App\User $editing_user
     *
     * @return mixed
     */
    public function updateCompanyInfo(User $editing_user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param \App\User $source_user
     *
     * @return mixed
     */
    public function delete(User $source_user)
    {
        return false;
    }
}
