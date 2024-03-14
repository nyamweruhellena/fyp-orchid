<?php

namespace App\Orchid\Screens\Properties;

use App\Models\Property;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout as FacadesLayout;


class PropertieEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $exists = false;
    public $name = 'Create Property';
    public $description = 'Create Property';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Property $property): array
    {
        $this->exists = $property->exists;

        if($this->exists) $this->description='Update Property ';
        return [
            'property' => $property
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
                    Input::make('property.name')
                        ->title('Name')
                        ->required()
                        ->placeholder('Enter property name'),
    
                    Input::make('property.serial_no')
                        ->title('Serial Number')
                        ->required()
                        ->placeholder('Enter property serial number'),
                ]),

                Group::make([
                    TextArea::make('property.description')
                        ->title('Description')
                        // ->required()
                        ->placeholder('Enter property description'),

                    Select::make('property.type')
                        ->options([
                                'electrical' => 'Electrical',
                                'electronics' => 'Electronics',
                                'computing' => 'Computing',
                                'furniture' => 'Furniture',
                                'plumbing' => 'Plumbing'
                            ])
                        ->title('Select type'),
                    
                ]),

                Group::make([
                    Input::make('property.college_block.name')
                        ->title('Location')
                        // ->required()
                        ->placeholder('Enter property location'),

                    Select::make('property.status')
                        ->options([
                                'Okay' => 'Okay',
                                'Not Okay' => 'Not Okay',
                            ])
                        ->title('Select status'),
                ])
            ])
        ];
    }

    public function createOrUpdate(Property $property,Request $request )
    {


       $property->fill($request->get('property'))->save();

        Alert::info('Property is created successfully');

        return redirect()->route('platform.properties');
    }


    public function delete(Property $property)
    {
        $property->delete();

        Alert::info('You have successfully deleted a property');

        return redirect()->route('platform.properties');
    }
}
