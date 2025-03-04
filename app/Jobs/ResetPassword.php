<?php

namespace App\Jobs;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPassword implements ShouldQueue
{
    use Queueable;

	protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $randomString = Str::random(12);

		$newPassword = implode('-', str_split($randomString, 4));

		$this->user->update([
            'password' => Hash::make($newPassword)
        ]);

		Mail::to($this->user->email)->send(new PasswordResetMail($this->user, $newPassword));
    }
}
