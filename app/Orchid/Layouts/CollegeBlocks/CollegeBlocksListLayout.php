<?php

namespace App\Orchid\Layouts\CollegeBlocks;

use App\Models\CollegeBlock;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class CollegeBlocksListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'college_blocks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name','Name')
                ->render(function(CollegeBlock $collegeBlock){
                    return Link::make($collegeBlock->name)
                    ->route('platform.college_blocks.edit',$collegeBlock);
                }),
        ];
    }
}
