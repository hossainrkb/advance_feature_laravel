<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewCustomerListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
 

    public function handle($event)
    {
        sleep(10);
        Mail::to($event->hola)->send(new WelcomeNewUserMail($event->hola1));
    }
}
