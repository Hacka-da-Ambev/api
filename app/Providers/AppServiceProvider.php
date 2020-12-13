<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\Beer\Ports\In\IBeerService;
use Source\Beer\Ports\Out\IBeerRepository;
use Source\Beer\Repositories\BeerEloquentRepository;
use Source\Beer\Services\BeerService;
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
        $this->app->bind(
            IBeerService::class,
            BeerService::class
        );

        // Adapters
        $this->app->bind(
            IUserRepository::class,
            UserEloquentRepository::class
        );
        $this->app->bind(
            IBeerRepository::class,
            BeerEloquentRepository::class
        );
    }
}
