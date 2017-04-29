<?php

namespace App\Policies;

use App\User;
use App\App\Models\Surveys\Survey;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the survey.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Surveys\Survey  $survey
     * @return mixed
     */
    public function view(User $user, Survey $survey)
    {
        //
    }

    /**
     * Determine whether the user can create surveys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the survey.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Surveys\Survey  $survey
     * @return mixed
     */
    public function update(User $user, Survey $survey)
    {
        //
    }

    /**
     * Determine whether the user can delete the survey.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Surveys\Survey  $survey
     * @return mixed
     */
    public function delete(User $user, Survey $survey)
    {
        //
    }
}
