<?php

namespace App\Providers;

use App\Events\NewHolahasRegisteredEvant;
use App\Events\vaiEvent;
use App\Listeners\vaiListener;
use App\Listeners\WelcomeNewCustomerListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewHolahasRegisteredEvant::class => [
            WelcomeNewCustomerListener::class,
        ],
        vaiEvent::class =>[
            vaiListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
