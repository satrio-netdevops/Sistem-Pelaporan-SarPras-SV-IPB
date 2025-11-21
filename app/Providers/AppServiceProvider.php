<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\RestockRequest;

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
        // Share 'pendingCount' to navigation view
        View::composer('layouts.navigation', function ($view) {
        $pendingCount = RestockRequest::where('status', 'pending')->count();
        $view->with('pendingCount', $pendingCount);
    });
    }
}