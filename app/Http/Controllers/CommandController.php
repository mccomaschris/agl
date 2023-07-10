<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function handicaps()
    {
        Artisan::call('agl:hc');
        return response()->json(['message' => 'Handicaps updated!']);
    }

    public function stats()
    {
        Artisan::call('agl:stats');
        return response()->json(['message' => 'Stats updated!']);
    }

    public function cache(Request $request)
    {
        sleep(1);
        $exitCode = Artisan::call('cache:clear');
        // $request->session()->flash('message.content', 'Cache cleared!');
		return back()->with(['message' => 'Something you want to pass to front-end']);
        // return response()->json('data' => 'Something you want to pass to front-end');
    }
}
