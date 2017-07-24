<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\View;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer(['dashboard.layout.dashboard','endusers.organizations.report','endusers.layout.dashboard_no_sidebar','endusers.layout.dashboard','endusers.citizens.menu'], function ($view) {
            $view->with('auth_user', Auth::user());
            $view->with('impersonator',session('impersonator'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
