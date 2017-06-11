<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * MailAdminEmail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.adminMessage');
    }
}
