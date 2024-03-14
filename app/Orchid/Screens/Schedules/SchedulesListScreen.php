<?php

namespace App\Orchid\Screens\Schedules;

use App\Models\ScheduleMaintenance;
use App\Orchid\Layouts\Schedules\SchedulesListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class SchedulesListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Schedule';
    public $description = 'List of all Scheduled Maintenance';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'schedule_maintenances' => ScheduleMaintenance::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.schedule_maintenances.edit',null)
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            SchedulesListLayout::class
        ];
    }
}
