<?php namespace Tekton\API\Providers;

use Illuminate\Support\ServiceProvider;
use Tekton\API\ApiManager;

class ApiProvider extends ServiceProvider
{
    function provides()
    {
        return ['api'];
    }

    function register()
    {
        // Register the API Manager
        $this->app->singleton('api', function($app) {
            $config = $app['config']->get('api');

            return new ApiManager($config);
        });
    }
}
