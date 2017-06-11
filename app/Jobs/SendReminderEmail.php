<?php

namespace App\Jobs;

use App\Mail\Verification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * SendReminderEmail constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $check = Mail::to($email)->send(new Verification());
        if($check) Log::info("Good");
    }

    /**
     *
     */
    public function handle()
    {

    }
}
