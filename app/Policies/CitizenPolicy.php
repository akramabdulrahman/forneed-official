<?php

namespace App\Policies;

use App\User;
use App\Models\Users\Citizen;
use Illuminate\Auth\Access\HandlesAuthorization;

class CitizenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the citizen.
     *
     * @param  \App\User  $user
     * @param  App\Models\Users\Citizen  $citizen
     * @return mixed
     */
    public function view(User $user, Citizen $citizen)
    {
        //
    }

    /**
     * Determine whether the user can create citizens.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the citizen.
     *
     * @param  \App\User  $user
     * @param  App\Models\Users\Citizen  $citizen
     * @return mixed
     */
    public function update(User $user, Citizen $citizen)
    {
        //
    }

    /**
     * Determine whether the user can delete the citizen.
     *
     * @param  \App\User  $user
     * @param  App\Models\Users\Citizen  $citizen
     * @return mixed
     */
    public function delete(User $user, Citizen $citizen)
    {
        //
    }
}
