<?php

namespace App\Providers;

use App\Listeners\AuditTrailSubscriber;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::subscribe(AuditTrailSubscriber::class);

        // Custom error pages
        View::share('_errors', true);
    }
}
