<?php

namespace App\Orchid\Screens\CollegeBlocks;

use App\Models\CollegeBlock;
use App\Orchid\Layouts\CollegeBlocks\CollegeBlocksListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class CollegeBlocksListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'College Blocks';
    public $description = 'List of all college blocks';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'college_blocks' => CollegeBlock::paginate()
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
                ->route('platform.college_blocks.edit',null)
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
            CollegeBlocksListLayout::class
        ];
    }
}
