<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Socialite;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $googleUser = Socialite::driver('google')->user();

            // find user in the database where the social id is the same with the id provided by Google
			$finduser = User::where('email', $googleUser->email)->first();

            if ($finduser)  {
                // Log the user in
                Auth::login($googleUser);

                // redirect user to dashboard page
                return redirect('/');
            }
            else {
                return response('Unauthorized.', 401);
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
