<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Player extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Player>
     */
    public static $model = \App\Models\Player::class;

    /**
	 * Get the value that should be displayed to represent the resource.
	 *
	 * @return string
	 */
	public function title()
	{
		return $this->user->name;
	}

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

			BelongsTo::make('User')
				->filterable()
				->readonly(),

			BelongsTo::make('Team')
				->readonly(),

			BelongsTo::make('Year')
				->filterable()
				->readonly(),

			Select::make('Tee Selection', 'tee_selection')->options([
				'yellow' => 'Yellow',
				'white' => 'White',
			])
			->nullable()
			->sortable()
			->filterable(),

            Number::make('Position', 'position')
				->default(0),

            Number::make('Current Handicap', 'hc_current')
				->default(0),

            Number::make('1st Quarter Handicap', 'hc_first')
				->hidefromIndex()
				->default(0),

            Number::make('2nd Quarter Handicap', 'hc_second')
				->hidefromIndex()
				->default(0),

            Number::make('3rd Quarter Handicap', 'hc_third')
				->hidefromIndex()
				->default(0),

            Number::make('4th Quarter Handicap', 'hc_fourth')
				->hidefromIndex()
				->default(0),

            Number::make('Playoff Handicap', 'hc_playoff')
				->hidefromIndex()
				->default(0),

            Number::make('Next Season Handicap', 'hc_next_year')
				->hidefromIndex()
				->default(0),

            Number::make('18 Hole Handicap', 'hc_18')
				->hidefromIndex()
				->default(0),

            Number::make('Full Handicap', 'hc_full')
				->hidefromIndex()
				->default(0)
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('Full Handicap rank', 'hc_full_rank')
				->hidefromIndex()
				->default(0),

            Number::make('Won', 'won')
				->hidefromIndex()
				->default(0),

            Number::make('Lost', 'lost')
				->hidefromIndex()
				->default(0),

            Number::make('Tied', 'tied')
				->hidefromIndex()
				->default(0),

           	Number::make('Winning Percentage', 'win_pct')
			   ->nullable()
			   ->min(0)
			   ->max(1)
			   ->step('any')
			   ->hidefromIndex()
			   ->default(0),

            Number::make('Points', 'points')
				->hidefromIndex()
				->default(0),

            Number::make('Points Rank', 'points_rank')
				->hidefromIndex()
				->default(0),

            Number::make('Wins Rank', 'wins_rank')
				->hidefromIndex()
				->default(0),

            Number::make('Gross Average', 'gross_average')
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->hidefromIndex()
				->default(0),

            Number::make('Gross to Par', 'gross_par')
				->nullable()
			   ->min(1)
			   ->max(1000)
			   ->step('any')
			   ->hidefromIndex()
			   ->default(0),

            Number::make('Net Average', 'net_average')
				->nullable()
			   ->min(1)
			   ->max(1000)
			   ->step('any')
			   ->hidefromIndex()
			   ->default(0),

            Number::make('Net to Par', 'net_par')
				->nullable()
			   ->min(1)
			   ->max(1000)
			   ->step('any')
			   ->hidefromIndex()
			   ->default(0),

            Number::make('Low Gross Score', 'low_gross')
				->hidefromIndex()
				->default(0),

            Number::make('High Gross Score', 'high_gross')
				->hidefromIndex()
				->default(0),

            Number::make('Low Net Score', 'low_net')
				->hidefromIndex()
				->default(0),

            Number::make('High Net Score', 'high_net')
				->hidefromIndex()
				->default(0),

            Number::make('Net Score Position Rank', 'position_net_rank')
				->hidefromIndex()
				->default(0),

            Number::make('Net Score Overall Rank', 'overall_net_rank')
				->hidefromIndex()
				->default(0),

			HasMany::make('Scores'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
