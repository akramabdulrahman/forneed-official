<?php

namespace App\Policies;

use App\User;
use App\App\Models\Users\SocialWorker;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialWorkerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the socialWorker.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Users\SocialWorker  $socialWorker
     * @return mixed
     */
    public function view(User $user, SocialWorker $socialWorker)
    {
        //
    }

    /**
     * Determine whether the user can create socialWorkers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the socialWorker.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Users\SocialWorker  $socialWorker
     * @return mixed
     */
    public function update(User $user, SocialWorker $socialWorker)
    {
        //
    }

    /**
     * Determine whether the user can delete the socialWorker.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Users\SocialWorker  $socialWorker
     * @return mixed
     */
    public function delete(User $user, SocialWorker $socialWorker)
    {
        //
    }
}
