<?php

namespace App\Jobs;

use App\Reservation;
use Illuminate\Bus\Queueable;
use App\Mail\PendingBookingMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PandingBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $key ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking_key)
    {
        $this->key = $booking_key;
       // dump( $this->key);
      // Log::alert("booking key: ". $this->key);
      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        
         $all_reservation =   Reservation::Where("booking_key",$this->key )->first();
        if($all_reservation->alert_send == NULL){
            Log::alert("inside booking key: ". $this->key);
             
$all_reservation->alert_send = 1;
         $all_reservation->save();
        }
        
         
       // Mail::to("rakib.151045@gmail.com")->send(new PendingBookingMail( $this->key));
        //dump("get data");
        //Log::alert("booking key ". $this->key);
    }
}
