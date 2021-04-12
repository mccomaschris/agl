<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Waitlist;

class AddedToWaitlist extends Mailable
{
    use Queueable, SerializesModels;

    public $waitlist;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Waitlist $waitlist)
    {
        $this->waitlist = $waitlist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.added-waitlist');
    }
}
