<?php

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

Route::get('/collection/{profile}/{player}', [\App\Http\Controllers\CollectionController::class, 'index']);
//Route::get('/collection/{profile}/{player_uuid}/{hour}', [\App\Http\Controllers\CollectionController::class, 'index_timeable']);
Route::get('/collection/{profile}/{player_uuid}/a', [\App\Http\Controllers\CollectionController::class, 'index_item_spec']);

Route::prefix('/graph')->group(function() {
    Route::post('collection', [\App\Http\Controllers\GraphController::class, 'collection_graph_api']);
    Route::post('coins', [\App\Http\Controllers\GraphController::class, 'coins_graph_api']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
