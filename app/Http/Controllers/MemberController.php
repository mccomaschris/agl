<?php

namespace App\Http\Controllers;

use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('active', 1)->orderBy('name')->get();
        return view('members.index', compact('users'));
    }
}
