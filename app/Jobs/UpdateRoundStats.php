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

        $score->gross = array_sum([
            $score->hole_1, $score->hole_2, $score->hole_3,
            $score->hole_4, $score->hole_5, $score->hole_6,
            $score->hole_7, $score->hole_8, $score->hole_9
        ]);

        // Calculate Net Score for Player Week
        switch ($week->week_order) {
            case in_array($week->week_order, range(1, 5)):
                $score->net = $score->gross - $score->player->hc_first;
                break;
            case in_array($week->week_order, range(6, 10)):
                $score->net = $score->gross - $score->player->hc_second;
                break;
            case in_array($week->week_order, range(11, 15)):
                $score->net = $score->gross - $score->player->hc_third;
                break;
            case in_array($week->week_order, range(16, 20)):
                $score->net = $score->gross - $score->player->hc_fourth;
                break;
        }

        $score->gross_par = $score->gross - 37;
        $score->net_par = $score->net - 37;

        // Reset Eagle, Birdie, Par, Bogey, and Double Bogey Count
        $score->eagle = $score->birdie = $score->par = $score->bogey = $score->double_bogey = 0;

         // Set Par 3, Par 4, and Par 5 holes
         $par_3s = [$score->hole_2, $score->hole_6];
         $par_4s = [$score->hole_1, $score->hole_3, $score->hole_4, $score->hole_8];
         $par_5s = [$score->hole_5, $score->hole_7, $score->hole_9];

         // Par 3 Eagle, Birdie, Par, Bogey, and Double Bogey Count
         foreach ($par_3s as $hole) {
             if ($hole <= 1) {
                 $score->eagle++;
             } elseif ($hole == 2) {
                 $score->birdie++;
             } elseif ($hole == 3) {
                 $score->par++;
             } elseif ($hole == 4) {
                 $score->bogey++;
             } elseif ($hole >= 5) {
                 $score->double_bogey++;
             }
         }

         // Par 4 Eagle, Birdie, Par, Bogey, and Double Bogey Count
         foreach ($par_4s as $hole) {
             if ($hole <= 2) {
                 $score->eagle++;
             } elseif ($hole == 3) {
                 $score->birdie++;
             } elseif ($hole == 4) {
                 $score->par++;
             } elseif ($hole == 5) {
                 $score->bogey++;
             } elseif ($hole >= 6) {
                 $score->double_bogey++;
             }
         }

         // Par 5 Eagle, Birdie, Par, Bogey, and Double Bogey Count
         foreach ($par_5s as $hole) {
             if ($hole <= 3) {
                 $score->eagle++;
             } elseif ($hole == 4) {
                 $score->birdie++;
             } elseif ($hole == 5) {
                 $score->par++;
             } elseif ($hole == 6) {
                 $score->bogey++;
             } elseif ($hole >= 7) {
                 $score->double_bogey++;
             }
         }

        $score->save();
    }
}
