<?php

namespace App\Jobs;

use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Week;

class UpdateRoundStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $score;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $score = $this->score;
        $week = Week::find($score->foreign_key);

        if (!$week) {
            return; // Avoid processing if the week isn't found
        }

        // Calculate Gross Score
        $score->gross = array_sum([
            $score->hole_1, $score->hole_2, $score->hole_3,
            $score->hole_4, $score->hole_5, $score->hole_6,
            $score->hole_7, $score->hole_8, $score->hole_9
        ]);

        // Determine Net Score
        $score->net = $this->calculateNetScore($score, $week->week_order);

		// Calculate Par Differences
        $score->gross_par = $score->gross - 37;
        $score->net_par = $score->net - 37;

        // Reset category counts
        $score->eagle = $score->birdie = $score->par = $score->bogey = $score->double_bogey = 0;

        // Define par values for each hole
        $par_3s = [$score->hole_2, $score->hole_6];
        $par_4s = [$score->hole_1, $score->hole_3, $score->hole_4, $score->hole_8];
        $par_5s = [$score->hole_5, $score->hole_7, $score->hole_9];

        // Categorize scores
        $this->categorizeScores($par_3s, 3, $score);
        $this->categorizeScores($par_4s, 4, $score);
        $this->categorizeScores($par_5s, 5, $score);

        $score->save();
    }

	/**
     * Calculate the net score based on the quarter.
     */
    private function calculateNetScore(Score $score, int $weekOrder): int
    {
        if ($weekOrder <= 5) {
            return $score->gross - $score->player->hc_first;
        } elseif ($weekOrder <= 10) {
            return $score->gross - $score->player->hc_second;
        } elseif ($weekOrder <= 15) {
            return $score->gross - $score->player->hc_third;
        } else {
            return $score->gross - $score->player->hc_fourth;
        }
    }

	/**
     * Categorize scores based on par values.
     */
    private function categorizeScores(array $holes, int $par, Score $score): void
    {
        foreach ($holes as $hole) {
            if ($hole <= $par - 2) {
                $score->eagle++;
            } elseif ($hole == $par - 1) {
                $score->birdie++;
            } elseif ($hole == $par) {
                $score->par++;
            } elseif ($hole == $par + 1) {
                $score->bogey++;
            } else {
                $score->double_bogey++;
            }
        }
    }
}
