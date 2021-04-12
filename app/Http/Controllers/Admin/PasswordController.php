<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminPasswordReset;

class PasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $password = str_random(10);

        $user->password = bcrypt($password);
        $user->save();

        // Mail::to($user())->send(new AdminPasswordReset($user, $password));
        Mail::to($user->email)->send(new AdminPasswordReset($user, $password));
        session()->flash('message', "User password has been reset and mailed to the user.");
        return redirect('/admin/users');
    }
}
