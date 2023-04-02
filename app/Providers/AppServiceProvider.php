<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Ekipisi\Admin\Config\Config;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        URL::forceScheme('https');
        Schema::defaultStringLength(191);
        Config::load();
    }

    public function register()
    {
        
    }
}
