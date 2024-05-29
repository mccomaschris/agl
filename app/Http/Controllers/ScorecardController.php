<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use App\Models\Week;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ScorecardController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param $week
     * @param  null  $team
     * @return View
     */
    public function edit($week, $team = null): View
    {
        $week = Week::find($week);

        if ($team) {
            $team = Team::find($team);
            $players = Player::where('team_id', '=', $team->id)->pluck('id');
            $scores = Score::where('week_id', '=', $week->id)->whereIn('player_id', $players)->get();
        } else {
            $team = null;
            $scores = Score::where('week_id', '=', $week->id)->with('player')->get();
        }

        return view('scores.edit', compact('week', 'scores', 'team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param $week
     * @return RedirectResponse
     */
    public function update(Request $request, $week): RedirectResponse
    {
        $this->validate($request, [
            'score.*.hole_1' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_2' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_3' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_4' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_5' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_6' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_7' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_8' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.hole_9' => 'required_if:score.*.absent,0|integer|nullable',
            'score.*.points' => 'required_if:score.*.absent,0|integer|nullable|between:0,2',
        ]);

        foreach ($request->score as $score) {
            $new_score = Score::find($score['score_id']);
            $new_score->absent = $score['absent'] == 'on' ? 1 : 0;
            $new_score->injury = $score['injury'] == 'on' ? 1 : 0;
            $new_score->substitute = $score['substitute'] == 'on' ? 1 : 0;
            $new_score->hole_1 = $score['hole_1'];
            $new_score->hole_2 = $score['hole_2'];
            $new_score->hole_3 = $score['hole_3'];
            $new_score->hole_4 = $score['hole_4'];
            $new_score->hole_5 = $score['hole_5'];
            $new_score->hole_6 = $score['hole_6'];
            $new_score->hole_7 = $score['hole_7'];
            $new_score->hole_8 = $score['hole_8'];
            $new_score->hole_9 = $score['hole_9'];
            $new_score->points = $score['points'];
            $new_score->save();
        }

        session()->flash('message', 'Scores have been updated');

        return back();
    }

    public function matchup($week)
    {
        $week = Week::find($week);

        return Player::where('team_id', '=', $week->a_first_id)->get();
    }
}
