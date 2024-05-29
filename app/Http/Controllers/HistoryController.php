<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use App\Models\Year;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HistoryController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        $year = Year::where('active', 1)->first();
        $years = Year::orderBy('name', 'desc')->get();
        $first_year = Year::orderBy('name', 'asc')->first();

        $team_champions = Cache::rememberForever('team_champions', function () {
            return Year::with([
                'teams' => function ($query) {
                    $query->where('champions', 1);
                },
            ])->orderby('name', 'desc')->get();
        });

        $individual_champions = Year::with([
            'players' => function ($query) {
                $query->where('champion', 1);
            },
        ])->orderby('name', 'desc')->get();

        $season_individual_most_points = Cache::rememberForever('season_individual_most_points', function () {
            return Player::with('year')->orderBy('points', 'desc')->take(10)->get();
        });

        $season_individual_least_points = Cache::rememberForever('season_individual_least_points', function () {
            return Player::with('year')->whereNotIn('id', [10, 60])->where('year_id', '!=', 8)->orderBy('points',
                'asc')->take(10)->get();
        });

        $season_individual_most_wins = Cache::rememberForever('season_individual_most_wins', function () {
            return Player::with('year')->orderBy('won', 'desc')->take(10)->get();
        });

        $season_individual_least_wins = Cache::rememberForever('season_individual_least_wins', function () {
            return Player::with('year')->whereNotIn('id', [10, 60])->where('year_id', '!=', 8)->orderBy('won',
                'asc')->take(10)->get();
        });

        $season_individual_most_ties = Cache::rememberForever('season_individual_most_ties', function () {
            return Player::with('year')->orderBy('tied', 'desc')->take(10)->get();
        });

        $season_individual_least_ties = Cache::rememberForever('season_individual_least_ties', function () {
            return Player::with('year')->whereNotIn('id', [10, 60])->orderBy('tied', 'asc')->take(10)->get();
        });

        $season_individual_most_losses = Cache::rememberForever('season_individual_most_losses', function () {
            return Player::with('year')->orderBy('lost', 'desc')->take(10)->get();
        });

        $season_individual_least_losses = Cache::rememberForever('season_individual_least_losses', function () {
            return Player::with('year')->whereNotIn('id', [10, 60])->where('year_id', '!=', 8)->orderBy('lost',
                'asc')->take(10)->get();
        });

        $season_individual_gross = Cache::rememberForever('season_individual_gross', function () {
            return Player::with('year')->where('gross_average', '>', 0)->orderBy('gross_average',
                'asc')->take(10)->get();
        });

        $season_individual_net = Cache::rememberForever('season_individual_net', function () {
            return Player::with('year')->where('net_average', '>', 0)->orderBy('net_average', 'asc')->take(10)->get();
        });

        $round_low_gross = Cache::rememberForever('round_low_gross', function () {
            return Score::with('player', 'week')->where('score_type', 'weekly_score')->where('gross', '>',
                0)->orderBy('gross', 'asc')->take(10)->get();
        });

        $round_low_net = Cache::rememberForever('round_low_net', function () {
            return Score::with('player', 'week')->where('score_type', 'weekly_score')->where('net', '>',
                0)->where('absent', false)->orderBy('net', 'asc')->take(10)->get();
        });

        $round_most_eagles = Cache::rememberForever('round_most_eagles', function () {
            return Score::with('player', 'week')->where('score_type', 'weekly_score')->where('absent',
                0)->where('eagle', '>', 0)->orderBy('eagle', 'desc')->take(10)->get();
        });

        $round_most_birdies = Cache::rememberForever('round_most_birdies', function () {
            return Score::with('player', 'week')->where('score_type', 'weekly_score')->where('absent',
                0)->where('birdie', '>', 0)->orderBy('birdie', 'desc')->take(10)->get();
        });

        $round_most_pars = Cache::rememberForever('round_most_pars', function () {
            return Score::with('player', 'week')->where('score_type', 'weekly_score')->where('absent', 0)->where('par',
                '>', 0)->orderBy('par', 'desc')->take(10)->get();
        });

        // 2020 is year 8
        $season_team_points = Cache::rememberForever('season_team_points', function () {
            return Team::with('year', 'players')->orderBy('points', 'desc')->take(10)->get();
        });

        $season_team_wins = Cache::rememberForever('season_team_wins', function () {
            return Team::with('year', 'players')->orderBy('won', 'desc')->take(10)->get();
        });

        $season_team_low_points = Cache::rememberForever('season_team_low_points', function () {
            return Team::with('year', 'players')->where('year_id', '!=', 8)->orderBy('points', 'asc')->take(10)->get();
        });

        $season_team_low_wins = Cache::rememberForever('season_team_low_wins', function () {
            return Team::with('year', 'players')->where('year_id', '!=', 8)->orderBy('won', 'asc')->take(10)->get();
        });

        $season_team_losses = Cache::rememberForever('season_team_losses', function () {
            return Team::with('year', 'players')->orderBy('lost', 'desc')->take(10)->get();
        });

        $season_team_low_losses = Cache::rememberForever('season_team_low_losses', function () {
            return Team::with('year', 'players')->where('year_id', '!=', 8)->orderBy('lost', 'asc')->take(10)->get();
        });

        return view('history.index', compact(
            'year', 'years', 'first_year',
            'team_champions', 'individual_champions',
            'season_individual_most_points', 'season_individual_least_points',
            'season_individual_most_wins', 'season_individual_least_wins',
            'season_individual_most_ties', 'season_individual_least_ties',
            'season_individual_most_losses', 'season_individual_least_losses',
            'season_individual_gross', 'season_individual_net',
            'round_low_gross', 'round_low_net', 'round_most_eagles', 'round_most_birdies', 'round_most_pars',
            'season_team_points', 'season_team_low_points',
            'season_team_wins', 'season_team_low_wins',
            'season_team_losses', 'season_team_low_losses'
        ));
    }
}
