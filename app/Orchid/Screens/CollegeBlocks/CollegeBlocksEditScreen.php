<?php

namespace App\Orchid\Screens\CollegeBlocks;

use App\Models\CollegeBlock;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class CollegeBlocksEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $exists = false;
    public $name = 'Create Block';
    public $description = 'Create Block';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(CollegeBlock $collegeBlock): array
    {
        $this->exists = $collegeBlock->exists;

        if($this->exists) $this->description='Update Block';
        return [
            'college_block' => $collegeBlock
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
                Input::make('college_block.name')
                        ->title('Name')
                        ->required()
                        ->placeholder('Enter block name'),
            ])
        ];
    }


    public function createOrUpdate(CollegeBlock $collegeBlock,Request $request )
    {


       $collegeBlock->fill($request->get('college_block'))->save();

        Alert::info('Block is created successfully');

        return redirect()->route('platform.college_blocks');
    }


    public function delete(CollegeBlock $collegeBlock)
    {
        $collegeBlock->delete();

        Alert::info('You have successfully deleted a block');

        return redirect()->route('platform.college_blocks');
    }
}
