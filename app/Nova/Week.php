<?php

namespace App\Nova;

use App\Nova\Actions\AddOneWeek;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Week extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Week>
     */
    public static $model = \App\Models\Week::class;

    /**
	 * Get the value that should be displayed to represent the resource.
	 *
	 * @return string
	 */
	public function title()
	{
		return $this->year->name . ' Week #' . $this->week_order;
	}

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'week_order',
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

			BelongsTo::make('Year')
				->filterable()
				->sortable(),

			Date::make('Date', 'week_date'),

			Number::make('Week Order/Name', 'week_order')
				->sortable()
				->default(0),

			Select::make('Side Game', 'side_games')->options([
				'Pin' => 'Pin',
				'Net' => 'Net',
				'Putts' => 'Putts',
			])
			->sortable()
			->filterable(),

			BelongsTo::make('Team A', 'team_a', 'App\Nova\Team')
				->hideFromIndex(),

			BelongsTo::make('Team B', 'team_b', 'App\Nova\Team')
				->hideFromIndex(),

			BelongsTo::make('Team C', 'team_c', 'App\Nova\Team')
				->hideFromIndex(),

			BelongsTo::make('Team D', 'team_d', 'App\Nova\Team')
				->hideFromIndex(),

			BelongsTo::make('Team E', 'team_e', 'App\Nova\Team')
				->hideFromIndex(),

			BelongsTo::make('Team F', 'team_f', 'App\Nova\Team')
				->hideFromIndex(),



			// $table->integer('year_id')->unsigned();
            // $table->integer('week_order')->default(0);
            // $table->date('week_date');
            // $table->string('side_games');
            // $table->integer('a_first_id')->unsigned();
            // $table->integer('a_second_id')->unsigned();
            // $table->integer('b_first_id')->unsigned();
            // $table->integer('b_second_id')->unsigned();
            // $table->integer('c_first_id')->unsigned();
            // $table->integer('c_second_id')->unsigned();
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
        return [
			AddOneWeek::make(),
		];
    }
}
