<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\CitizenRepository::class, \App\Repositories\CitizenRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServiceProviderRepository::class, \App\Repositories\ServiceProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChartRepository::class, \App\Repositories\ChartRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SocialWorkerRepository::class, \App\Repositories\SocialWorkerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChartRepository::class, \App\Repositories\ChartRepositoryEloquent::class);
        //:end-bindings:
    }
}
