<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Game\{
    GameController
};
use App\Http\Controllers\Sport\{
    SportCategoryController,
    SportController,
    SportPlayController,
    SportTypeController,
    SportLeagueController,
    SportTeamController,
};

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

Route::prefix('sport')->group(function () {
    Route::post('/', [SportController::class, 'post']);
    Route::get('/{id}', [SportController::class, 'get'])
        ->whereNumber('id');

    Route::post('/category', [SportCategoryController::class, 'post']);
    Route::get('/category/{id}', [SportCategoryController::class, 'get'])
        ->whereNumber('id');

    Route::post('/type', [SportTypeController::class, 'post']);
    Route::get('/type/{id}', [SportTypeController::class, 'get'])
        ->whereNumber('id');

    Route::post('/play', [SportPlayController::class, 'post']);
    Route::get('/play/{id}', [SportPlayController::class, 'get'])
        ->whereNumber('id');

    Route::post('/league', [SportLeagueController::class, 'post']);
    Route::get('/league', [SportLeagueController::class, 'getList']);
    Route::get('/league/{id}', [SportLeagueController::class, 'get'])
        ->whereNumber('id');

    Route::post('/team', [SportTeamController::class, 'post']);
    Route::get('/team', [SportTeamController::class, 'getList']);
    Route::get('/team/{id}', [SportTeamController::class, 'get'])
        ->whereNumber('id');
});



Route::prefix('game')->group(function () {
    Route::post('/', [GameController::class, 'post']);
    Route::get('/{id}', [GameController::class, 'get'])
        ->whereNumber('id');
});
