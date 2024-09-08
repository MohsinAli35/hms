<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
// use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        
            // // Fetch a single settings record
            // $settings = Setting::first(); // Get the first record of the settings
    
            // // Share the settings instance with all views
            // View::share('settings', $settings);
        
        Paginator::useBootstrapFive();
    }
}
