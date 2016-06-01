<?php

namespace NettworkProject\Providers;

use Illuminate\Support\ServiceProvider;
use NettworkProject\Repositories\ClientRepository;
use NettworkProject\Repositories\ClientRepositoryEloquent;

class NettworkProjectRepositoryProvider extends ServiceProvider
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
        $this->app->bind(ClientRepository::class, ClientRepositoryEloquent::class);
    }
}
