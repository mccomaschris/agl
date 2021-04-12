<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::with('teams')->orderBy('name', 'desc')->get();

        return view('admin.teams.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $years = Year::orderBy('name', 'desc')->get();
        // return view('admin.teams.create', compact('years'));
        return redirect('/admin/teams');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'year_id' => 'required',
        //     'name' => 'required',
        // ]);

        // $team = Team::create([
        //     'year_id' => request('year_id'),
        //     'name' => request('name'),
        // ]);

        // session()->flash('message', "Team {$team->name} has been created.");
        return redirect('/admin/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return $team;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $years = Year::orderBy('name', 'desc')->get();
        return view('admin.teams.edit', compact('team', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request, [
            'year_id' => 'required',
            'name' => 'required',
        ]);

        $champions = $request->champions == 'on' ? 1 : 0;
        $request->merge(['champions' => $champions]);

        $team->update($request->all());

        session()->flash('message', "Team {$team->name} has been edited.");
        return redirect('/admin/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        // $team->delete();
        // session()->flash('message', "Team {$team->name} has been deleted.");
        return redirect('/admin/teams');
    }
}
