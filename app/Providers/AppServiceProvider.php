<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        // Set default timezone to Asia/Jakarta (WIB+7)
        date_default_timezone_set('Asia/Jakarta');

        // Set Carbon's default timezone
        Carbon::setLocale('id');

        // Set the default timezone for Carbon
        config(['app.timezone' => 'Asia/Jakarta']);
    }
}
