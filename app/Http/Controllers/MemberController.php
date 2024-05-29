<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::where('active', 1)->orderBy('name')->get();

        return view('members.index', compact('users'));
    }
}
