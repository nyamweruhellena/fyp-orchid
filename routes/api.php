<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\PropertyController;

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

// Test API
Route::get('/test', function () {
    return response()->json(['message' => 'FYP API up and running'], 200);
});

// AUTH API
Route::post('/login', [AuthController::class, 'login'])->name('login.api');
Route::post('/register', [AuthController::class, 'register'])->name('register.api');

Route::apiResource('properties', PropertyController::class)->middleware('withoutlinks');

// REPORTS API
Route::apiResource('reports', ReportController::class);
Route::get('officer/{id?}', [PropertyController::class,'getOfficer']);
