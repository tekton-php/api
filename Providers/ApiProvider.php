<?php namespace Tekton\API\Providers;

use Tekton\ServiceProvider;
use Tekton\API\ApiManager;

class ApiProvider extends ServiceProvider {

    function register() {
        // Register the API Manager
        $this->app->singleton('api', function() {
            $timeout = $this->app->make('config')->get('api.timeout');

            return new ApiManager($timeout);
        });
    }
}
