<?php

namespace Eybos\Providers;

use Illuminate\Support\ServiceProvider;
use Eybos\View\Composers;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->composer(['layouts.auth', 'layouts.backend'], Composers\AddStatusMessage::class);
        $this->app['view']->composer('layouts.backend', Composers\AddAdminUser::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
