<?php

namespace App\Orchid\Screens\Properties;

use App\Models\Property;
use App\Orchid\Layouts\Properties\PropertiesListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class PropertiesListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Properties';
    public $description = 'List of all Properties';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'properties'=> Property::paginate()
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
                ->route('platform.properties.edit',null)
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
            PropertiesListLayout::class
        ];
    }
}
