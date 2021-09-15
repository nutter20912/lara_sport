<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sport\{
    SportCategoryController,
    SportController,
    SportPlayController,
    SportTypeController,
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
    /** 體育 */
    Route::post('/', [SportController::class, 'post']);
    Route::get('/{id}', [SportController::class, 'get'])->whereNumber('id');

    /** 類別 */
    Route::post('/category', [SportCategoryController::class, 'post']);
    Route::get('/category/{id}', [SportCategoryController::class, 'get'])->whereNumber('id');

    /** 場別 */
    Route::post('/type', [SportTypeController::class, 'post']);
    Route::get('/type/{id}', [SportTypeController::class, 'get'])->whereNumber('id');

    /** 玩法 */
    Route::post('/play', [SportPlayController::class, 'post']);
    Route::get('/play/{id}', [SportPlayController::class, 'get'])->whereNumber('id');
});
