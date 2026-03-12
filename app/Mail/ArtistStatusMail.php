<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArtistStatusMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $status;

    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Your Account Status Updated')
                    ->view('emails.artist-status');
    }
}