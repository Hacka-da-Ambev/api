<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\User\Ports\In\IAuthenticationService;
use Source\User\Ports\Out\IUserRepository;
use Source\User\Repositories\UserEloquentRepository;
use Source\User\Services\AuthenticationService;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ports
        $this->app->bind(
            IAuthenticationService::class,
            AuthenticationService::class
        );

        // Adapters
        $this->app->bind(
            IUserRepository::class,
            UserEloquentRepository::class
        );
    }
}
