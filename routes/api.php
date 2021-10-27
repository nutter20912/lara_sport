<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Game\{
    GameController
};
use App\Http\Controllers\Sport\{
    SportCategoryController,
    SportGroupController,
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
    Route::post('group', [SportGroupController::class, 'post']);
    Route::get('group', [SportGroupController::class, 'getAll']);
    Route::get('group/category/{id}', [SportGroupController::class, 'getByCategory'])
        ->whereNumber('id');

    Route::post('/category', [SportCategoryController::class, 'post']);
    Route::get('category', [SportCategoryController::class, 'getAll']);
    Route::get('/category/{id}', [SportCategoryController::class, 'get'])
        ->whereNumber('id');

    Route::post('/type', [SportTypeController::class, 'post']);
    Route::get('/type', [SportTypeController::class, 'getAll']);
    Route::get('/type/{id}', [SportTypeController::class, 'get'])
        ->whereNumber('id');

    Route::post('/play', [SportPlayController::class, 'post']);
    Route::get('/play', [SportPlayController::class, 'getAll']);
    Route::get('/play/{id}', [SportPlayController::class, 'get'])
        ->whereNumber('id');

    Route::post('/league', [SportLeagueController::class, 'post']);
    Route::get('/league', [SportLeagueController::class, 'getAll']);
    Route::get('/league/{id}', [SportLeagueController::class, 'get'])
        ->whereNumber('id');

    Route::post('/team', [SportTeamController::class, 'post']);
    Route::get('/team/{id}', [SportTeamController::class, 'get'])
        ->whereNumber('id');
    Route::get('/team/league/{id}', [SportTeamController::class, 'getByLeague'])
        ->whereNumber('id');
});



Route::prefix('game')->group(function () {
    Route::post('/', [GameController::class, 'post']);
    Route::get('/{id}', [GameController::class, 'get'])
        ->whereNumber('id');
    Route::get('/category/{id}', [GameController::class, 'getByCategory'])
        ->whereNumber('id');
});
