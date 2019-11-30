<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewUserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mama_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->mama_name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-welcome');
    }
}
