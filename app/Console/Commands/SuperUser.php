<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class SuperUser extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'agl:super';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Super User';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		if ($this->confirm("Are you sure you want to create a Super User?", 'yes')) {

			$x = true;
			while ($x == true) {

				$username = $this->ask('Username');

				if (!User::where('username', '=', $username)->first()) {
					$user = new User;
					$user->username = $username;
					$x = false;
				} else {
					$this->error("\n\n  A user with this username already exists. Please try again.\n");
				}

			}

			$x = true;
			while ($x == true) {

				$password_input = $this->secret('Password');
				$password_verify = $this->secret('Re-enter Password');

				if ($password_input == $password_verify) {
					$user->password = bcrypt($password_input);
					$x = false;
				} else {
					$this->error("\n\n  Passwords do not match. Please try again.\n");
				}

			}

			$user->name = $this->ask('Name');
			$user->email = $this->ask('Email');
			$user->phone = $this->ask('Phone');
			$user->active = 1;
			$user->admin = 1;
			$user->save();

			$this->info("\nUser {$user->username} has been saved.");

		}

	}
}
