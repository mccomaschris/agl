<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\Models\Team;
use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use App\Models\Player;
use Carbon\Carbon;
use App\Filters\PlayerFilters;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::with('players')->orderBy('name', 'desc')->get();

        return view('admin.players.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        $teams = Team::with('year')->orderBy('id', 'desc')->get();
        return view('admin.players.create', compact('users', 'teams'));
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
            'user_id' => 'required',
            'team_id' => 'required',
            'position' => 'required',
            'hc_current' => 'required'
        ]);

        $team = Team::find($request->team_id);

        $player = Player::create([
            'user_id' => $request->user_id,
            'team_id' => $request->team_id,
            'year_id' => $team->year_id,
            'position' => $request->position,
            'hc_current' => $request->hc_current,
            'hc_full' => 0,
            'hc_full_rank' => 0,
            'substitute' => $request->substitute == 'on' ? 1 : 0,
            'on_leave' => $request->on_leave == 'on' ? 1 : 0,
        ]);

        return redirect('/admin/players')->with('flash', "Player has been created.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $users = User::orderBy('name', 'asc')->get();
        $teams = Team::with('year')->orderBy('id', 'desc')->get();
        return view('admin.players.edit', compact('player', 'teams', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'team_id' => 'required',
            'position' => 'required'
        ]);

        $substitute = $request->substitute == 'on' ? 1 : 0;
        $on_leave = $request->on_leave == 'on' ? 1 : 0;

        $request->merge(['substitute' => $substitute, 'on_leave' => $on_leave]);

        $player->update($request->all());

        return redirect('/admin/players')->with('flash', "Player has been edited.");
    }


    public function show(Player $player)
    {
        $team = Team::find($player->team_id);
        $year = Year::find($team->year_id);
        $years = Year::orderBy('name', 'desc')->get();
        $weeks = Week::where('year_id', $year->id)->orderby('week_order', 'asc')->get();
        $scores = Score::with('player', 'week')->where('player_id', $player->id)->where('score_type', 'weekly_score')->get();
        $players = DB::table('players')
            ->join('teams', 'players.team_id', '=', 'teams.id')
            ->join('users', 'players.user_id', '=', 'users.id')
            ->join('years', 'teams.year_id', '=', 'years.id')
            ->select('players.*', 'users.name', 'years.name as year_name')
            ->where('teams.year_id', $year->id)->orderBy('users.name', 'asc')->get();

        return view('admin.players', compact('player', 'year', 'years', 'weeks', 'week', 'scores', 'players'));

    }
}
