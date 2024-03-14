<?php

namespace App\Orchid\Screens\Schedules;

use App\Models\ScheduleMaintenance;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class SchedulesEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $exists = false;
    public $name = 'Create Schedule';
    public $description = 'Create Schedule';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(ScheduleMaintenance $schedule_maintenance): array
    {
        $this->exists = $schedule_maintenance->exists;

        if($this->exists) $this->description='Update Schedule';

        return [
            'schedule_maintenance' => $schedule_maintenance
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
            Button::make('create')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->exists)
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
            Layout::rows([
                Group::make([
                    Input::make('schedule_maintenance.property.id')
                        ->title('Property name')
                        // ->required()
                        ->placeholder('Enter property name'),

                    Select::make('schedule_maintenance.status')
                        ->options([
                                'maintained' => 'Maintained',
                                'not maintained' => 'Not maintained',
                            ])
                        ->title('Select status'),
                        ]),
                Group::make([
                    Input::make('schedule_maintenance.last_maintenance')
                        ->title('Last maintenance')
                        ->required()
                        ->placeholder('Enter last maintenance date'),

                    Input::make('schedule_maintenance.next_maintenance')
                        ->title('Next maintenance')
                        ->required()
                        ->placeholder('Enter next maintenance date'),
                ]),
            ])
        ];
    }

    public function createOrUpdate(ScheduleMaintenance $schedule_maintenance,Request $request )
    {


        $schedule_maintenance->fill($request->get('schedule_maintenance'))->save();

        Alert::info('Schedule is created successfully');

        return redirect()->route('platform.schedule_maintenances');
    }


    public function delete(ScheduleMaintenance $schedule_maintenance)
    {
        $schedule_maintenance->delete();

        Alert::info('You have successfully deleted a schedule');

        return redirect()->route('platform.schedule_maintenances');
    }
}
