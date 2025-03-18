<?php

namespace App\Http\Middleware;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CspMiddleware;

class CspMiddlewareRegistration extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register CSP Middleware globally
        $this->app['router']->pushMiddlewareToGroup('web', CspMiddleware::class);
    }
}
