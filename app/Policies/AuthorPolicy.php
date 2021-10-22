<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Author;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the author can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the author can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function view(User $user, Author $model)
    {
        return true;
    }

    /**
     * Determine whether the author can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the author can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function update(User $user, Author $model)
    {
        return true;
    }

    /**
     * Determine whether the author can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function delete(User $user, Author $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the author can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function restore(User $user, Author $model)
    {
        return false;
    }

    /**
     * Determine whether the author can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Author  $model
     * @return mixed
     */
    public function forceDelete(User $user, Author $model)
    {
        return false;
    }
}
