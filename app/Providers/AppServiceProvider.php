<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('MainServiceProvider', function ($app) {
            return new \App\Http\Libraries\Providers\MainServiceProvider();
        });
        $this->app->singleton('ExMailer', function ($app) {
            return new \App\Http\Libraries\EmailSenders\MailerFactory();
        });
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'MainServiceProvider',
            'ExMailer'
        ];
    }
}
