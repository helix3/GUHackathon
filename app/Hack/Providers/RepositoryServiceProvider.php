<?php namespace Hack\Providers;

use Hack\Repositories\Sas\EloquentSas;
use Hack\SasList;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('Hack\Repositories\Sas\SasInterface', function ($app) {
            return new EloquentSas(new SasList);

        });
    }
}
