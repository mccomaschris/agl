<?php

namespace App\Http\Controllers\Admin;

use App\Models\Week;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class WeekScoreController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Week $week
     * @return \Illuminate\Http\Response
     */
    public function edit(Week $week)
    {
        $weeks = Week::where('year_id', $week->year_id)->orderby('week_order', 'asc')->get();

        $matchup_1 = DB::table('scores')
                    ->join('players', 'scores.player_id', '=', 'players.id')
                    ->join('teams', 'players.team_id', '=', 'teams.id')
                    ->join('users', 'players.user_id', '=', 'users.id')
                    ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
                    ->select('teams.name as team_name', 'teams.id', 'users.name as player_name', 'scores.*')
                    ->whereRaw('weeks.id = ? and score_type = "weekly_score" and (teams.id =? or teams.id = ?)', [$week->id, $week->a_first_id, $week->a_second_id])
                    ->orderBy('players.position', 'asc')
                    ->orderBy('teams.name', 'asc')
                    ->get();

        $matchup_2 = DB::table('scores')
                    ->join('players', 'scores.player_id', '=', 'players.id')
                    ->join('teams', 'players.team_id', '=', 'teams.id')
                    ->join('users', 'players.user_id', '=', 'users.id')
                    ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
                    ->select('teams.name as team_name', 'teams.id', 'users.name as player_name', 'scores.*')
                    ->whereRaw('weeks.id = ? and score_type = "weekly_score" and (teams.id =? or teams.id = ?)', [$week->id, $week->b_first_id, $week->b_second_id])
                    ->orderBy('players.position', 'asc')
                    ->orderBy('teams.name', 'asc')
                    ->get();

        $matchup_3 = DB::table('scores')
                    ->join('players', 'scores.player_id', '=', 'players.id')
                    ->join('teams', 'players.team_id', '=', 'teams.id')
                    ->join('users', 'players.user_id', '=', 'users.id')
                    ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
                    ->select('teams.name as team_name', 'teams.id', 'users.name as player_name', 'scores.*')
                    ->whereRaw('weeks.id = ? and score_type = "weekly_score" and (teams.id =? or teams.id = ?)', [$week->id, $week->c_first_id, $week->c_second_id])
                    ->orderBy('players.position', 'asc')
                    ->orderBy('teams.name', 'asc')
                    ->get();

        return view('admin.week-score.edit', compact('week', 'weeks', 'matchup_1', 'matchup_2', 'matchup_3'));
    }
}
