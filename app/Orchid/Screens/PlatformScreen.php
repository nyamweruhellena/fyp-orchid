<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\ChartsLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'CPMS Dashboard';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to CPMS Dashboard!';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            //
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
            Link::make('Go to Site')
                ->href('#')
                ->icon('globe-alt')
                ->target('_blank'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            // ChartsLayout::class
            Layout::view('home')
        ];
    }
}
