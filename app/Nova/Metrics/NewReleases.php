<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\Table;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Http\Requests\NovaRequest;

class NewReleases extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return [
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('Silver Surfer')
                ->subtitle('In every part of the globe it is the same!')
                ->actions(function () {
                    return [
                        MenuItem::externalLink('View release notes', '/releases/1.0'),
                        MenuItem::externalLink('Share on Twitter', 'https://twitter.com/intent/tweet?text=Check%20out%20the%20new%20release'),
                    ];
                }),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }
}
