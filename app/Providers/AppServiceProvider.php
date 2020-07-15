<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ArticleService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleService::class, function ($app) {
            return new ArticleService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
