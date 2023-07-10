<?php

namespace Agl\TotalHoles;

use App\Models\Score;
use Laravel\Nova\Card;

class TotalHoles extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'total-holes';
    }

	 /**
     * Indicates that the analytics should show current visitors.
     *
     * @return $this
     */
	public function totalScores()
    {
        return $this->withMeta([
			'totalScores' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->count(),
			'hole_1' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_1'),
			'hole_2' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_2'),
			'hole_3' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_3'),
			'hole_4' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_4'),
			'hole_5' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_5'),
			'hole_6' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_6'),
			'hole_7' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_7'),
			'hole_8' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_8'),
			'hole_9' => Score::where('score_type', 'weekly_score')->where('player.position', '!=', '4')->avg('hole_9'),
		]);
    }
}
