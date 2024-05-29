<?php

namespace App\Http\Controllers;

use App\Mail\AddedToWaitlist;
use App\Models\Waitlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WaitlistController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $members = Waitlist::where('active', 1)->orderby('created_at', 'asc')->get();

        return view('waitlist.index', compact('members'));
    }

    /**
     * @param  Request  $request
     * @param  Waitlist  $waitlist
     * @return RedirectResponse
     */
    public function store(Request $request, Waitlist $waitlist): RedirectResponse
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
