<?php

namespace App\Http\Controllers\Admin;

use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index()
    {
        $year = Year::where('active', 1)->first();
        $weeks = Week::where('year_id', $year->id)->orderBy('week_order', 'desc')->get();
        $last_week = Week::where('year_id', $year->id)->where('week_date', '<=', Carbon::yesterday())->orderBy('week_date', 'desc')->first();

        return view('admin.index', compact('year', 'weeks', 'last_week'));
    }

    public function rankings()
    {

        $one = Score::where('score_type', 'weekly_score')->whereNotNull('hole_1')->average('hole_1');
        $two = Score::where('score_type', 'weekly_score')->whereNotNull('hole_2')->average('hole_2');
        $three = Score::where('score_type', 'weekly_score')->whereNotNull('hole_3')->average('hole_3');
        $four = Score::where('score_type', 'weekly_score')->whereNotNull('hole_4')->average('hole_4');
        $five = Score::where('score_type', 'weekly_score')->whereNotNull('hole_5')->average('hole_5');
        $six = Score::where('score_type', 'weekly_score')->whereNotNull('hole_6')->average('hole_6');
        $seven = Score::where('score_type', 'weekly_score')->whereNotNull('hole_7')->average('hole_7');
        $eight = Score::where('score_type', 'weekly_score')->whereNotNull('hole_8')->average('hole_8');
        $nine = Score::where('score_type', 'weekly_score')->whereNotNull('hole_9')->average('hole_9');

        return view('admin.rankings', compact('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'));
    }

    public function topten() {

        $headers = [
			'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
			'Content-type'        => 'text/csv',
			'Content-Disposition' => 'attachment; filename=topten.csv',
			'Expires'             => '0',
			'Pragma'              => 'public'
		];

        $year = Year::where('active', 1)->first();
        $players = Player::with('user')->where('year_id', $year->id)->orderBy('position')->get();

        $callback = function() use ($weeks) {
            $FH = fopen('php://output', 'w');

            fputcsv($FH, array('Player', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'));

            foreach ($players as $player) {
                $scores = Score::where('score_type', 'weekly_score')->whereNotNull('hole_1')->where('player_id', $player->id)->orderBy('gross')->get();
                $output = array($player->user->name);

                foreach ($scores as $score) {
                    $output[] = $score->gross;
                }

                fputcsv($FH, $output);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
