<?php

namespace App\Orchid\Screens\Reports;

use App\Models\Report;
use App\Orchid\Layouts\ReportFiltersLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\App;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\Reports\ReportsListLayout;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'reports' => Report::with('property')
                ->filters()
                ->filtersApplySelection(ReportFiltersLayout::class)
                ->paginate(),
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
            Button::make('Download')
                ->icon('cloud-download')
                ->method('downloadAllReports')
                ->rawClick(),
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
            ReportFiltersLayout::class,
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

    public function downloadAllReports()
    {
        $reports = Report::with('property')->get();

        $rows = [];
        foreach ($reports as $report) {
            $row_string = '<tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">' . $report->property->name . '</td>
                <td class="py-3 px-6 text-left">' . $report->name . '</td>
                <td class="py-3 px-6 text-left">' . $report->description . '</td>
                <td class="py-3 px-6 text-left">' . $report->status . '</td>
                <td class="py-3 px-6 text-left">' . $report->created_at->toFormattedDateString() . '</td>
            </tr>';
            array_push($rows, $row_string);
        }

        $list = implode('', $rows);

        $html_view = '
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #999;
            padding: 0.75rem;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
        </style>
        <div class="table-responsive">
        <h3>All Reports  <span style="float:right">' . date('D, M d, Y') . '</span></h3>
            <table>
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Property</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    ' . $list . '
                </tbody>
            </table>
        </div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html_view);

        try {
            return $pdf->stream('all_reports.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
        }
    }
}
