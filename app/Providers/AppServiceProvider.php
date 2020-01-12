<?php

namespace App\Providers;

use \App\PostGardProvider;
use App\Billings\PaymentGetway;
use Illuminate\Support\Facades\Schema;
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
        $this->app->singleton(PaymentGetway::class,function($app){
            return new PaymentGetway("BDT");
        });
        $this->app->singleton('PostHere',function($app){
            return new PostGardProvider(4,3);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
