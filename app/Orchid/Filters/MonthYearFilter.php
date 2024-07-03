<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Field;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Illuminate\Database\Eloquent\Builder;

class MonthYearFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['month', 'year'];

    /**
     * @return string
     */
    public function name(): string
    {
        return 'Month & Year';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder
            ->whereMonth('created_at', $this->request->get('month'))
            ->whereYear('created_at', $this->request->get('year'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Select::make('year')
                ->options(array_combine(range(2011, now()->year), range(2011, now()->year)))
                ->title('Select a Year'),
            Select::make('month')
                ->options($this->monthRange())
                ->title('Select a Month'),
        ];
    }

    protected function monthRange()
    {
        $range = [];

        for ($i = 1; $i <= 12; $i++) {
            $range[$i] = date('M', mktime(0, 0, 0, $i));
        }
        return $range;
    }
}
