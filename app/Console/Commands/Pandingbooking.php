<?php

namespace App\Console\Commands;

use App\Reservation;
use App\Jobs\PandingBookingJob;
use Illuminate\Console\Command;

class Pandingbooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hola';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $all_reservation =   Reservation::all();
      foreach ($all_reservation as $value) {
          if($value->is_confirmed == 0 && $value->paid == 1 ){
              //dump($value->booking_key);
              dispatch (new PandingBookingJob($value->booking_key));
          }
          else{
              continue;
          }
      }
    }
}
