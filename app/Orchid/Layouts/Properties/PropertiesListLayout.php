<?php

namespace App\Orchid\Layouts\Properties;

use App\Models\Property;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class PropertiesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'properties';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name','Name')
                ->render(function(Property $property){
                    return Link::make($property->name)
                    ->route('platform.properties.edit',$property);
                }),
            
            TD::make('serial_no','Serial Number')
                ->render(function(Property $property){
                    return $property->serial_no;
                }),

            TD::make('status','Status')
                ->render(function(Property $property){
                    return $property->status;
                }),

            TD::make('type','Type')
                ->render(function(Property $property){
                    return $property->type;
                }),
        ];
    }
}
