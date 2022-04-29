<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use App\Models\Player;
use App\Models\PlayerRecord;
use Illuminate\Support\Facades\Cache;

class PlayerScoreController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        $qtr_1 =  Cache::remember("query:player:qtr_1:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('substitute', 0)->where('player_id', $player->id)->quarter(1)->get();
        });
        $qtr_2 =  Cache::remember("query:player:qtr_2:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('substitute', 0)->where('player_id', $player->id)->quarter(2)->get();
        });
        $qtr_3 =  Cache::remember("query:player:qtr_3:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('substitute', 0)->where('player_id', $player->id)->quarter(3)->get();
        });
        $qtr_4 =  Cache::remember("query:player:qtr_4:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('substitute', 0)->where('player_id', $player->id)->quarter(4)->get();
        });

        $qtr_1_avg = Cache::remember("query:player:qtr_1_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_1_avg')->where('substitute', 0)->where('player_id', $player->id)->first();
        });
        $qtr_2_avg = Cache::remember("query:player:qtr_2_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_2_avg')->where('substitute', 0)->where('player_id', $player->id)->first();
        });
        $qtr_3_avg = Cache::remember("query:player:qtr_3_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_3_avg')->where('substitute', 0)->where('player_id', $player->id)->first();
        });
        $qtr_4_avg = Cache::remember("query:player:qtr_4_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_4_avg')->where('substitute', 0)->where('player_id', $player->id)->first();
        });
        $season_avg = Cache::remember("query:player:season_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'season_avg')->where('substitute', 0)->where('player_id', $player->id)->first();
        });

        $weekly_wins = Score::with('week')->where('substitute', 0)->where('player_id', $player->id)->where('weekly_winner', 1)->orderBy('id', 'asc')->get();

        $opponents = Cache::remember("query:player:opponents:{$player->id}", 1440, function () use ($player) {
            return PlayerRecord::with('opponent')->where('substitute', 0)->where('player_id', $player->id)->get();
        });

        $scores =  Cache::remember("query:player:total_scores:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')
                        ->where('substitute', 0)->where('player_id', $player->id)
                        ->countingscores()
                        ->get();
        });

        if ( $player->id === 159 ) {
            $total_count = 8;
        } else {
            $total_count = round(count($scores) / 2);
        }


        $highest =  Score::where('score_type', 'weekly_score')
                        ->where('substitute', 0)->where('player_id', $player->id)
                        ->where('gross', '>', 0)
                        ->where('absent', 0)
                        ->where('substitute_id', 0)
                        ->orderBy('gross', 'asc')
                        ->skip($total_count - 1)
                        ->take(1)
                        ->pluck('gross');


        $counted =  Cache::remember("query:player:counted_scores:{$player->id}", 1440, function () use ($player, $scores, $total_count) {
            return Score::where('score_type', 'weekly_score')
                        ->where('substitute', 0)->where('player_id', $player->id)
                        ->countingscores()
                        ->orderBy('gross', 'asc')
                        ->take($total_count)
                        ->pluck('gross');
        });

        $prev_seasons = $player->previous_seasons();

        return view('player-score.show',
            compact('player', 'qtr_1', 'qtr_2', 'qtr_3', 'qtr_4',
                'qtr_1_avg', 'qtr_2_avg', 'qtr_3_avg', 'qtr_4_avg', 'season_avg',
                'opponents', 'counted', 'prev_seasons', 'highest', 'weekly_wins'));
    }
}
