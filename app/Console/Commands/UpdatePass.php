<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UpdatePass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:pwreset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset a user password';

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
        $username = $this->ask('Username');
        $user = User::where('username', '=', $username)->first();

        if ($user) {

            $x = true;
            while ($x == true) {

                $password_input = $this->secret('Password');
                $password_verify = $this->secret('Re-enter Password');

                if ($password_input == $password_verify) {
                    $user->password = bcrypt($password_input);
                    $user->save();
                    $this->info("\n  User password has been saved.");
                    $x = false;
                } else {
                    $this->error("\n\n  Passwords do not match. Please try again.\n");
                }

            }

        } else {
            $this->error("\n\n  A user with this username does not exist exists. Please try again.\n");
        }

    }
}
