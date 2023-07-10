<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Team extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Team>
     */
    public static $model = \App\Models\Team::class;

    /**
	 * Get the value that should be displayed to represent the resource.
	 *
	 * @return string
	 */
	public function title()
	{
		return $this->year->name . ' Team #' . $this->name;
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
			Text::make('name')->sortable(),

			Text::make('points'),

			BelongsTo::make('Year')
				->filterable(),

			Number::make('won')
				->onlyOnForms(),

            Number::make('lost')
				->onlyOnForms(),

            Number::make('tied')
				->onlyOnForms(),

            Number::make('rank')
				->onlyOnForms(),

            Number::make('p1_points')
				->onlyOnForms(),

            Number::make('p2_points')
				->onlyOnForms(),

            Number::make('p3_points')
				->onlyOnForms(),

            Number::make('p4_points')
				->onlyOnForms(),

			Boolean::make('champions'),

			HasMany::make('Players'),
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
