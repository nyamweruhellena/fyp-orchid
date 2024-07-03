<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Field;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Illuminate\Database\Eloquent\Builder;

class ReportStatusFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'status',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Status');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('status', $this->request->get('status'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Select::make('status')
                ->options([
                    'done'   => 'Done',
                    'Not done' => 'Not done',
                    'In progress' => 'In progress',
                    'Fixed' => 'Fixed',
                ])
                ->empty()
                ->title(__('Status')),
        ];
    }
}
