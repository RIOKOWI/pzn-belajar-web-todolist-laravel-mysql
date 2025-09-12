<?php

namespace App\Providers;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{

    
    

    /**
     * Register services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->singleton(UserService::class, UserServiceImpl::class);
    }

    public function provides(): array
    {
        return [UserService::class];
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
}
