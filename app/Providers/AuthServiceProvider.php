<?php

namespace App\Providers;

use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\Payments\Payment;
use App\Models\Project;
use App\Models\Surveys\Survey;
use App\Models\Users\Permission;
use App\Models\Users\SocialWorker;
use App\Policies\CitizenPolicy;
use App\Policies\ExtraPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ServiceProviderPolicy;
use App\Policies\SocialWorkerPolicy;
use App\Policies\SurveyPolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        Citizen::class => CitizenPolicy::class,// citizen can view a citizen dashboard, make a service request,submit a survey,change profile settings/password
        ServiceProvider::class => ServiceProviderPolicy::class,// sp can view serviceProvider dashboard, make a project,survey,make payment,change profile settings/password
        SocialWorker::class => SocialWorkerPolicy::class,// sw can view sw dashboard, submit a survey,make payment request,change profile settings/password
        Project::class => ProjectPolicy::class,//only admin can accept a project // project cant be created until sp is accepted
        Payment::class => PaymentPolicy::class,
        Extra::class => ExtraPolicy::class,
        ExtraType::class => ExtraType::class,
        Survey::class => SurveyPolicy::class
        /*todo add readonly field to user*/
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $gate->define('edit-html-blocks', function ($user) {
            // Add your logic here
            return $user->hasRole('admin');
        });
        $this->registerPolicies();
        Passport::routes();
        Passport::enableImplicitGrant();


        // Dynamically register permissions with Laravel's Gate.
        if(Auth::user()){
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }

    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
