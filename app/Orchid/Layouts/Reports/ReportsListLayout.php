<?php

namespace App\Orchid\Layouts\Reports;

use App\Models\Report;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReportsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reports';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('property_id','Name')
                ->render(function(Report $report){
                    return $report->property->name;
                }),

            TD::make('description','Description')
                ->render(function(Report $report){
                    return $report->description;
                }),

            TD::make('status','Status')
                ->render(function(Report $report){
                    return $report->status;
                }),

            TD::make('cost','Cost')
                ->render(function(Report $report){
                    return $report->cost;
                }),
        ];
    }
}
