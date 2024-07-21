<?php

namespace App\Providers;

use App\Http\Middleware\VisitorTracker;
use Illuminate\Support\ServiceProvider;

class VisitorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app['router']->pushMiddleWareToGroup('web', VisitorTracker::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
