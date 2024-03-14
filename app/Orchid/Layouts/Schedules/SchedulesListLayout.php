<?php

namespace App\Orchid\Layouts\Schedules;

use App\Models\ScheduleMaintenance;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class SchedulesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'schedule_maintenances';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('property_id','Name')
                ->render(function(ScheduleMaintenance $schedule_maintenance){
                    return Link::make($schedule_maintenance->property->name)
                    ->route('platform.schedule_maintenances.edit',$schedule_maintenance);
                }),

            TD::make('last_maintenance','Last maintenance')
                ->render(function(ScheduleMaintenance $schedule_maintenance){
                    return $schedule_maintenance->last_maintenance;
                }),

            TD::make('next_maintenance','Next maintenance')
                ->render(function(ScheduleMaintenance $schedule_maintenance){
                    return $schedule_maintenance->next_maintenamce;
                }),

            TD::make('status','Status')
                ->render(function(ScheduleMaintenance $schedule_maintenance){
                    return $schedule_maintenance->status;
                }),
        ];
    }
}
