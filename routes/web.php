<?php

use App\Jobs\FetchAndStoreProfile;
use App\Models\Profile;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/collection/{profile}/{player}/{item}', [\App\Http\Controllers\CollectionController::class, 'show']);

Route::get('/', function() {
    return Inertia::render('Welcome');
});

Route::get('/ae', function() {
    $result2 = DB::select(DB::raw("SELECT SUM(TABLE_ROWS)
   FROM INFORMATION_SCHEMA.TABLES
   WHERE TABLE_SCHEMA = 'yesman';"));

    $test = "SUM(TABLE_ROWS)";

    return response()->json($result2[0]->$test);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
