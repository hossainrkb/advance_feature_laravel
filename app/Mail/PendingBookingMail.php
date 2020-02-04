<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking_key;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking_key)
    {
        $this->booking_key = $booking_key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('mail_send');
    }
}
