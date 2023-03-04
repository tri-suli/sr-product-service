<?php

use App\Http\Controllers\FullRestApi\Categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::group(['prefix' => 'v1', 'as' => 'api'], function (Router $routerGroup) {
    $routerGroup->prefix('categories')->name('.category')->group(function (Router $router) {
        $router->post('/', Categories\StoreController::class)->name('.store');
        $router->patch('{id}', Categories\UpdateController::class)->name('.update');
    });
});
