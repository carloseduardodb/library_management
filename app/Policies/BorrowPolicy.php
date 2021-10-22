<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Borrow;
use Illuminate\Auth\Access\HandlesAuthorization;

class BorrowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the borrow can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the borrow can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function view(User $user, Borrow $model)
    {
        return true;
    }

    /**
     * Determine whether the borrow can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the borrow can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function update(User $user, Borrow $model)
    {
        return true;
    }

    /**
     * Determine whether the borrow can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function delete(User $user, Borrow $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the borrow can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function restore(User $user, Borrow $model)
    {
        return false;
    }

    /**
     * Determine whether the borrow can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Borrow  $model
     * @return mixed
     */
    public function forceDelete(User $user, Borrow $model)
    {
        return false;
    }
}
