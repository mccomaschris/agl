<?php

namespace App\Nova\Dashboards;

use Agl\TotalHoles\TotalHoles;
use Laravel\Nova\Dashboard;

class HoleInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            TotalHoles::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'hole-insights';
    }
}
