<?php

namespace App\Nova;

use Agl\TotalHoles\TotalHoles;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Score extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Score>
     */
    public static $model = \App\Models\Score::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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

			BelongsTo::make('Week')
				->filterable()
				->readonly(),

			Select::make('score_type')->options([
					'weekly_score' => 'weekly_score',
					'qtr_1_avg' => 'qtr_1_avg',
					'qtr_2_avg' => 'qtr_2_avg',
					'qtr_3_avg' => 'qtr_3_avg',
					'qtr_4_avg' => 'qtr_4_avg',
					'season_avg' => 'season_avg',
				])
				->sortable()
				->filterable()
				->readonly(),

			BelongsTo::make('Player')
				->filterable()
				->readonly(),

            Boolean::make('absent'),

            Boolean::make('injury'),

            Boolean::make('substitute'),

            Boolean::make('weekly_winner'),

            Number::make('hole_1')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_2')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_3')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_4')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_5')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_6')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_7')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_8')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('hole_9')
				->nullable()
				->min(1)
				->max(1000)
				->step('any'),

            Number::make('points')
				->nullable(),

            Number::make('gross')
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->readonly(),

            Number::make('gross_par')
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->readonly(),

            Number::make('net')
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->readonly(),

            Number::make('net_par')
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->readonly(),

            Number::make('eagle')
				->hideFromIndex()
				->nullable()
				->readonly(),

            Number::make('birdie')
				->hideFromIndex()
				->nullable()
				->readonly(),

            Number::make('par')
				->hideFromIndex()
				->nullable()
				->readonly(),

            Number::make('bogey')
				->hideFromIndex()
				->nullable()
				->readonly(),

            Number::make('double_bogey')
				->hideFromIndex()
				->nullable()
				->readonly(),

			Number::make('current_average')
				->hideFromIndex()
				->nullable()
				->min(1)
				->max(1000)
				->step('any')
				->readonly(),
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
