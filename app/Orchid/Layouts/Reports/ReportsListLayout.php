<?php

namespace App\Orchid\Layouts\Reports;

use App\Models\Report;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\ModalToggle;

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
            TD::make('name','Code')
                ->render(function(Report $report){
                    return $report->name;
                }),

            TD::make('property_id','Name')
                ->render(function(Report $report){
                    return $report->property->name;
                }),

            TD::make('description','Description')
                ->render(function(Report $report){
                    return $report->description;
                }),

            TD::make('date','Date')
                ->render(function(Report $report){
                    return $report->date;
                }),

            TD::make('status','Status')
                ->render(function(Report $report){
                    return $report->status;
                }),

            TD::make('cost','Cost')
                ->render(function(Report $report){
                    return $report->cost;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Report $report) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            ModalToggle::make('Add cost')
                                ->modal('Update Cost')
                                ->method('addCost')
                                ->asyncParameters([
                                    'id' => $report->id,
                                    'property_id' => $report->property_id,
                                    'description' => $report->description
                                ])
                                ->icon('pencil'),

                            ModalToggle::make('Update status')
                                ->modal('Update Status')
                                ->method('updateStatus')
                                ->asyncParameters([
                                    'id' => $report->id,
                                    'property_id' => $report->property_id,
                                    'description' => $report->description
                                ])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Report will be removed permanently. Please confirm submission.'))
                                ->method('remove', [
                                    'id' => $report->id,
                                ]),
                        ]);
                }),
        ];
    }
}
