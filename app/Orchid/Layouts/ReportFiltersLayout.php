<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\MonthYearFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\ReportStatusFilter;

class ReportFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            ReportStatusFilter::class,
            MonthYearFilter::class,
        ];
    }
}
