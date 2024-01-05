<?php

use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route::apiResource('users', ControllerName::class);
 * 
 * GET methods: index, show
 * index() => all values/paginated
 * show($id) => get a single resource
 * 
 * PUT
 * PATCH
 * update(Request $request, $id) => update a single resource specified by the id
 * 
 * POST
 * store(Request $request) => create a resource from passed request params
 * 
 * DElETE
 * destroy($id) => deletes a resource
 */

Route::apiResource('properties', PropertyController::class)->middleware('withoutlinks');
Route::post('order', [ReportController::class, 'create']);
