<?php

declare(strict_types=1);

use App\Models\ScheduleMaintenance;
use App\Orchid\Screens\CollegeBlocks\CollegeBlocksEditScreen;
use App\Orchid\Screens\CollegeBlocks\CollegeBlocksListScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\FAQs\FAQsEditScreen;
use App\Orchid\Screens\FAQs\FAQsListScreen;
use App\Orchid\Screens\News\NewsEditScreen;
use App\Orchid\Screens\News\NewsListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Properties\PropertieEditScreen;
use App\Orchid\Screens\Properties\PropertiesListScreen;
use App\Orchid\Screens\Reports\ReportsListScreen;
use App\Orchid\Screens\Schedules\SchedulesListScreen;
use App\Orchid\Screens\Schedules\SchedulesEditScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Home > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Home > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit');

// Home > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Home > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Home > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Home > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Home > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// NEWS

//platform > news
Route::screen('news', NewsListScreen::class)
    ->name('platform.news')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('News'),route('platform.news'));
    });

// Home > news > edit
Route::screen('news-edit/{news?}', NewsEditScreen::class)
    ->name('platform.news.edit')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.news')
            ->push(__('Edit'), route('platform.news.edit'));
    });

// FAQ

// Home > Faqs
Route::screen('faqs', FAQsListScreen::class)
    ->name('platform.faqs')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Faqs'),route('platform.faqs'));
    });

// Home > Faqs > Edit
Route::screen('faq/{faq?}', FAQsEditScreen::class)
    ->name('platform.faqs.faq')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.faqs')
            ->push(__('Edit'), route('platform.faqs.faq'));
    });

Route::screen('properties', PropertiesListScreen::class)
    ->name('platform.properties')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Properties'),route('platform.properties'));
    });

Route::screen('properties-edit/{properties?}', PropertieEditScreen::class)
    ->name('platform.properties.edit')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.properties')
            ->push(_('Edit'), route('platform.properties.edit'));
    });

Route::screen('reports', ReportsListScreen::class)
    ->name('platform.reports')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Reports'),route('platform.reports'));
    });

Route::screen('college_blocks', CollegeBlocksListScreen::class)
    ->name('platform.college_blocks')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Blocks'),route('platform.college_blocks'));
    });

Route::screen('college_blocks-edit/{college_blocks?}', CollegeBlocksEditScreen::class)
    ->name('platform.college_blocks.edit')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.college_blocks')
            ->push(_('Edit'), route('platform.college_blocks.edit'));
    });

Route::screen('schedule_maintenances', SchedulesListScreen::class)
    ->name('platform.schedule_maintenances')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Schedule'),route('platform.schedule_maintenances'));
    });

Route::screen('schedule_maintenances-edit/{schedule_maintenances?}', SchedulesEditScreen::class)
    ->name('platform.schedule_maintenances.edit')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.schedule_maintenances')
            ->push(_('Edit'), route('platform.schedule_maintenances.edit'));
    });
