<?php

namespace App\Providers;

use App\Models\Setting;
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
        $name = Setting::where('key', 'name')->value('value');
        $logo = Setting::where('key', 'logo')->value('value');

        View::share('appName', $name);
        View::share('appLogo', $logo);
    }
}
