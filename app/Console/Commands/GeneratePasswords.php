<?php

namespace App\Console\Commands;

use App\Mail\GenPass;
use App\User;
use Illuminate\Console\Command;

class GeneratePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:pass';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '2017 reboot, generate passwords for all users';

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
        $users = User::where('email', '!=', '')->where('active', 1)->where('username', '!=', 'cmccomas')->get();

        foreach ($users as $user) {

            $new_pass = str_random(8);
            $user->password = bcrypt($new_pass);
            $user->save();

            // Now send the email
            \Mail::to($user->email)
                ->bcc('mccomas.chris@gmail.com')
                ->send(new GenPass($user, $new_pass));

        }

    }
}
