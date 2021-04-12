<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use App\Mail\AddedToWaitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WaitlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Waitlist::where('active', 1)->orderby('created_at', 'asc')->get();
        return view('waitlist.index', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *wa
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Waitlist $waitlist)
    {
        $this->validate($request, [
            'name' => 'required',
            'projected_hc' => 'required|integer',
        ]);

        $waitlist = Waitlist::create([
            'user_id' => Auth::id(),
            'name' => request('name'),
            'projected_hc' => request('projected_hc'),
        ]);

        Mail::to('mccomas.chris@gmail.com')->send(new AddedToWaitlist($waitlist));

        return back();
    }
}
