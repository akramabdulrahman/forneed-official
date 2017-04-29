<?php

namespace App\Policies;

use App\User;
use App\Models\Users\ServiceProvider;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceProviderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the serviceProvider.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Users\ServiceProvider  $serviceProvider
     * @return mixed
     */
    public function view(User $user, ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Determine whether the user can create serviceProviders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the serviceProvider.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Users\ServiceProvider  $serviceProvider
     * @return mixed
     */
    public function update(User $user, ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Determine whether the user can delete the serviceProvider.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Users\ServiceProvider  $serviceProvider
     * @return mixed
     */
    public function delete(User $user, ServiceProvider $serviceProvider)
    {
        //
    }
}
