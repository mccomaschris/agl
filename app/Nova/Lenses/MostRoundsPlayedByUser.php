<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Number;

class MostRoundsPlayedByUser extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                  ->join('players', 'users.id', '=', 'players.user_id')
                  ->join('scores', 'scores.player_id', '=', 'players.id')
				  ->where('scores.score_type', 'weekly_score')
				  ->where('scores.gross', '>', 0)
                  ->orderBy('rounds_played', 'desc')
                  ->groupBy('users.id')
        ));
    }

	 /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'users.id',
            'users.name',
            DB::raw('count(scores.gross) as rounds_played'),
			DB::raw('sum(scores.eagle) as eagles'),
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
		return [
            ID::make('ID', 'id'),
            Text::make('Name', 'name'),

            Number::make('Rounds', 'rounds_played')
				->sortable(),
            Number::make('Eagles', 'scores.eagles')
				->sortable(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-rounds-played-by-user';
    }
}
