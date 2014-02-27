<?php namespace Tyloo\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Tyloo\Repositories\UserRepositoryInterface',
            'Tyloo\Repositories\Eloquent\UserRepository'
        );
    }

}