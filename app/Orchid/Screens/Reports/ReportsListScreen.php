<?php

namespace App\Orchid\Screens\Reports;

use App\Models\Report;
use App\Orchid\Layouts\Reports\ReportsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

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
            'reports'=> Report::paginate()
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
            ReportsListLayout::class
        ];
    }
}
