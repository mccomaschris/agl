<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Models\Week;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PrintScorecardController extends Controller
{
	/**
	* Display the specified resource.
	*
	* @param  $quarter
	* @return \Illuminate\Http\Response
	*/
	public function show($quarter)
	{

		$year = Year::where('active', 1)->first();

		switch ($quarter) {
			case 1:
			$weeks = Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->whereIn('week_order', range(1,5))->get();
			break;
			case 2:
			$weeks = Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->whereIn('week_order', range(6,10))->get();
			break;
			case 3:
			$weeks = Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->whereIn('week_order', range(11,15))->get();
			break;
			case 4:
			$weeks = Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->whereIn('week_order', range(16,20))->get();
			break;
			default:
			$weeks = null;
		}

		$headers = [
			'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
			'Content-type'        => 'text/csv',
			'Content-Disposition' => 'attachment; filename=matchups-qtr-'. $quarter  . '.csv',
			'Expires'             => '0',
			'Pragma'              => 'public'
		];

		$callback = function() use ($weeks)
		{
			$FH = fopen('php://output', 'w');

			fputcsv($FH, array('W', 'P1', 'H1', 'P2', 'H2'));

			foreach ($weeks as $week) {

				fputcsv($FH, array($week->week_order, $week->team_a->onePlayer->user->last_name,  $week->team_a->onePlayer->hc_current, $week->team_b->onePlayer->user->last_name,  $week->team_b->onePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_a->twoPlayer->user->last_name,  $week->team_a->twoPlayer->hc_current, $week->team_b->twoPlayer->user->last_name,  $week->team_b->twoPlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_a->threePlayer->user->last_name,  $week->team_a->threePlayer->hc_current, $week->team_b->threePlayer->user->last_name,  $week->team_b->threePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_a->fourPlayer->user->last_name,  $week->team_a->fourPlayer->hc_current, $week->team_b->fourPlayer->user->last_name,  $week->team_b->fourPlayer->hc_current));

				fputcsv($FH, array($week->week_order, $week->team_c->onePlayer->user->last_name,  $week->team_c->onePlayer->hc_current, $week->team_d->onePlayer->user->last_name,  $week->team_d->onePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_c->twoPlayer->user->last_name,  $week->team_c->twoPlayer->hc_current, $week->team_d->twoPlayer->user->last_name,  $week->team_d->twoPlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_c->threePlayer->user->last_name,  $week->team_c->threePlayer->hc_current, $week->team_d->threePlayer->user->last_name,  $week->team_d->threePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_c->fourPlayer->user->last_name,  $week->team_c->fourPlayer->hc_current, $week->team_d->fourPlayer->user->last_name,  $week->team_d->fourPlayer->hc_current));

				fputcsv($FH, array($week->week_order, $week->team_e->onePlayer->user->last_name,  $week->team_e->onePlayer->hc_current, $week->team_f->onePlayer->user->last_name,  $week->team_f->onePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_e->twoPlayer->user->last_name,  $week->team_e->twoPlayer->hc_current, $week->team_f->twoPlayer->user->last_name,  $week->team_f->twoPlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_e->threePlayer->user->last_name,  $week->team_e->threePlayer->hc_current, $week->team_f->threePlayer->user->last_name,  $week->team_f->threePlayer->hc_current));
				fputcsv($FH, array($week->week_order, $week->team_e->fourPlayer->user->last_name,  $week->team_e->fourPlayer->hc_current, $week->team_f->fourPlayer->user->last_name,  $week->team_f->fourPlayer->hc_current));
			}

			fclose($FH);
		};

		return Response::stream($callback, 200, $headers);
		}
	}
