<?php

namespace App\Policies;

use App\User;
use App\App\Models\ExtraType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExtraTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the extraType.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\ExtraType  $extraType
     * @return mixed
     */
    public function view(User $user, ExtraType $extraType)
    {
        //
    }

    /**
     * Determine whether the user can create extraTypes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the extraType.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\ExtraType  $extraType
     * @return mixed
     */
    public function update(User $user, ExtraType $extraType)
    {
        //
    }

    /**
     * Determine whether the user can delete the extraType.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\ExtraType  $extraType
     * @return mixed
     */
    public function delete(User $user, ExtraType $extraType)
    {
        //
    }
}
