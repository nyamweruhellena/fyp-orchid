<?php

namespace App\Orchid\Screens\Reports;

use App\Models\Report;
use App\Orchid\Layouts\Reports\ReportsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\ModalToggle;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Select;

class ReportsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Reports';
    public $description = 'List of all Reported Properties';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'reports' => Report::paginate()
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
            // ModalToggle::make('Add cost')
            // ->modal('Update Cost')
            // ->method('addCost')
            // ->icon('full-screen'),
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
            Layout::modal('Update Cost', [
                Layout::rows([
                    Input::make('report.cost')
                        ->title('Cost')
                        ->required()
                        ->placeholder('Amount')
                        ->help('Specify the amount of the maintenace used.'),
                ])
            ])->async('asyncGetPropertyId'),
              

            Layout::modal('Update Status', [
                Layout::rows([
                    Select::make('report.status')
                        ->options([
                                'In progress' => 'In progress',
                                'done' => 'done',
                                'Not done' => 'Not done',
                            ])
                        ->title('Select status'),
                ])
            ])->async('asyncGetPropertyId'),
            ReportsListLayout::class
        ];
    }

    public function asyncGetPropertyId(string $property_id, $id, $description): array
    {
        return [
            'property_id' => $property_id,
            'description' => $description,
            'id' => $id
        ];
    }

    public function addCost(Request $request)
    {
        // dd($request->all());

        $report = Report::find($request->id);
        $report->cost = $request->report['cost'];
        $report->description = $request->report['description'] ?? $request->description;
        $report->property_id = $request->property_id;
        $report->update();

        Alert::info('You have successfully updated cost of report.');

        return redirect()->route('platform.reports');
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());

        $report = Report::find($request->id);
        $report->status = $request->report['status'];
        $report->description = $request->report['description'] ?? $request->description;
        $report->property_id = $request->property_id;
        $report->update();

        Alert::info('You have successfully updated status of report.');

        return redirect()->route('platform.reports');
    }

    public function remove(Request $request): void
    {
        Report::findOrFail($request->get('id'))->delete();

        Toast::info(__('Report was deleted successfully'));
    }
}
