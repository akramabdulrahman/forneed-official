<?php

namespace App\Policies;

use App\User;
use App\App\Models\Extra;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExtraPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the extra.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Extra  $extra
     * @return mixed
     */
    public function view(User $user, Extra $extra)
    {
        //
    }

    /**
     * Determine whether the user can create extras.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the extra.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Extra  $extra
     * @return mixed
     */
    public function update(User $user, Extra $extra)
    {
        //
    }

    /**
     * Determine whether the user can delete the extra.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Extra  $extra
     * @return mixed
     */
    public function delete(User $user, Extra $extra)
    {
        //
    }
}
