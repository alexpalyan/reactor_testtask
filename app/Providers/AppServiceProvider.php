<?php

namespace App\Providers;

use App\Models\Url;
use App\Observers\UrlObserver;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Url::observe(UrlObserver::class);
    }
}
