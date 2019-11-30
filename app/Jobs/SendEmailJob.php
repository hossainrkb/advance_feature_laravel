<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $get_data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->get_data = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($f)
    {
       // dump($this->get_data);
        Mail::to("rakib.151045@gmail.com")->send(new SendEmailMailable());
    }
}
