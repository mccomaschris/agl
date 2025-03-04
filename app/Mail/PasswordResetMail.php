<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

	public $user;
    public $newPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Your Password Has Been Reset')
                    ->markdown('emails.password-reset', [
                        'user' => $this->user,
                        'newPassword' => $this->newPassword,
                    ]);
    }
}
