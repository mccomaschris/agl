<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Jobs\UpdateRoundStats;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateHandicaps;
use Validator;
use App\Jobs\UpdateRecordVsOpponents;
use App\Models\Player;

class ScoreController extends Controller
{

    public function show(Score $score)
    {
        return view('admin.week-score.score-row', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Score $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        sleep(1);
        $validator = Validator::make($request->all(), [
            'hole_1' => 'integer|nullable',
            'hole_2' => 'integer|nullable',
            'hole_3' => 'integer|nullable',
            'hole_4' => 'integer|nullable',
            'hole_5' => 'integer|nullable',
            'hole_6' => 'integer|nullable',
            'hole_7' => 'integer|nullable',
            'hole_8' => 'integer|nullable',
            'hole_9' => 'integer|nullable',
            'points' => 'integer|nullable|between:0,2',
        ]);

        if ($validator->fails()) {
            // $request->session()->flash('message.level', 'error');
            // $request->session()->flash('message.content', 'There was an error! ' . $score->player->user->name . '\'s score was not saved. ');
            abort(204);
        }

        $score->update($request->all());

        $player = Player::find($score->player_id);
        $year = Year::find($player->year_id);

        UpdateRoundStats::withChain([
            new UpdatePlayerStats($score->player),
            new UpdateHandicaps($score->player),
            new UpdateRecordVsOpponents($year)
        ])->dispatch($score);

        // return view('admin.week-score.score-row', compact('score'));
    }
}
