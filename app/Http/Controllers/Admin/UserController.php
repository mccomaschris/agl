<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(25);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt(str_random(10)),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'active' => $request->active == 'on' ? 1 : 0,
            'admin' => $request->admin == 'on' ? 1 : 0,
        ]);

        return redirect('/admin/users')->with('flash', "User has been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$user->id,
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
        ]);

        $active = $request->active == 'on' ? 1 : 0;
        $admin = $request->admin == 'on' ? 1 : 0;

        $request->merge(['active' => $active, 'admin' => $admin]);

        $user->update($request->all());

        return redirect('/admin/users')->with('flash', "User {$user->username} has been edited.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
