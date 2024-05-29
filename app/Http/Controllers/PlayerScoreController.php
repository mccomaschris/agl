<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Player;
use App\Models\PlayerRecord;
use App\Models\Score;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PlayerScoreController extends Controller
{
    /**
     * @param  Player  $player
     * @return View
     */
    public function show(Player $player): View
    {
        $qtr_1 = Cache::remember("query:player:qtr_1:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('player_id',
                $player->id)->quarter(1)->get();
        });
        $qtr_2 = Cache::remember("query:player:qtr_2:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('player_id',
                $player->id)->quarter(2)->get();
        });
        $qtr_3 = Cache::remember("query:player:qtr_3:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('player_id',
                $player->id)->quarter(3)->get();
        });
        $qtr_4 = Cache::remember("query:player:qtr_4:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')->with('week')->where('player_id',
                $player->id)->quarter(4)->get();
        });

        $qtr_1_avg = Cache::remember("query:player:qtr_1_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_1_avg')->where('player_id', $player->id)->first();
        });
        $qtr_2_avg = Cache::remember("query:player:qtr_2_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_2_avg')->where('player_id', $player->id)->first();
        });
        $qtr_3_avg = Cache::remember("query:player:qtr_3_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_3_avg')->where('player_id', $player->id)->first();
        });
        $qtr_4_avg = Cache::remember("query:player:qtr_4_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'qtr_4_avg')->where('player_id', $player->id)->first();
        });
        $season_avg = Cache::remember("query:player:season_avg:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'season_avg')->where('player_id', $player->id)->first();
        });

        $weekly_wins = Score::with('week')->where('player_id', $player->id)->where('weekly_winner', 1)->orderBy('id',
            'asc')->get();

        $opponents = Cache::remember("query:player:opponents:{$player->id}", 1440, function () use ($player) {
            return PlayerRecord::with('opponent')->where('player_id', $player->id)->get();
        });

        $notes = Note::where('player_id', $player->id)->where('active', 1)->get();

        $scores = Cache::remember("query:player:total_scores:{$player->id}", 1440, function () use ($player) {
            return Score::where('score_type', 'weekly_score')
                ->where('player_id', $player->id)
                ->countingscores()
                ->get();
        });

        if ($player->id === 159) {
            $total_count = 8;
        } else {
            $total_count = round(count($scores) / 2);
        }

        $highest = Score::where('score_type', 'weekly_score')
            ->where('player_id', $player->id)
            ->where('gross', '>', 0)
            ->where('absent', 0)
            ->where('substitute_id', 0)
            ->orderBy('gross', 'asc')
            ->skip($total_count - 1)
            ->take(1)
            ->pluck('gross');

        $counted = Cache::remember("query:player:counted_scores:{$player->id}", 1440,
            function () use ($player, $total_count) {
                return Score::where('score_type', 'weekly_score')
                    ->where('player_id', $player->id)
                    ->countingscores()
                    ->orderBy('gross', 'asc')
                    ->take($total_count)
                    ->pluck('gross');
            });

        $prev_seasons = $player->previous_seasons();

        return view('player-score.show',
            compact('player', 'qtr_1', 'qtr_2', 'qtr_3', 'qtr_4', 'notes',
                'qtr_1_avg', 'qtr_2_avg', 'qtr_3_avg', 'qtr_4_avg', 'season_avg',
                'opponents', 'counted', 'prev_seasons', 'highest', 'weekly_wins'));
    }
}
