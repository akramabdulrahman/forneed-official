<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Survey;
use App\Models\Users\Citizen;
use App\Notifications\CitizenCreated;
use App\Notifications\ProjectCreated;
use App\Notifications\ServiceProviderCreated;
use App\Notifications\SurveyCreated;
use App\User;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class DBEventsProvider extends ServiceProvider
{

    private function sendNotificationToAdmin($notificationInstance)
    {
        Notification::send(User::where('is_admin', true)->get(), $notificationInstance);;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Citizen::created(function ($citizen) {
            $citizenNotification = new CitizenCreated($citizen);
            Notification::send($citizenNotification->getTargets(),$citizenNotification );;
        });

        Project::created(function ($project) {
            $projectNotification = new ProjectCreated($project);
            Notification::send($projectNotification->getTargets(),$projectNotification );;
        });

        \App\Models\Users\ServiceProvider::created(function ($sp) {
            $serviceProviderNotification = new ServiceProviderCreated($sp);
            Notification::send($serviceProviderNotification->getTargets(),$serviceProviderNotification );;
        });

        \App\Models\Surveys\Survey::created(function ($survey) {
            $surveyNotification = new SurveyCreated($survey);
            Notification::send($surveyNotification->getTargets(),$surveyNotification);;
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
